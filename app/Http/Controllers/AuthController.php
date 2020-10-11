<?php

namespace App\Http\Controllers;

use App\User;
use App\GuestHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistrationFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use DateTime;
use DateInterval;
use JWTAuth;
use Exception;
use Illuminate\Mail\Message;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Helper\mailHelper;
use App\Helper\jwtHelper;
use App\Helper\UploadHelper;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserGetOneResource;
use App\Events\Registered;
use App\Events\ForgetPassword;

class AuthController extends Controller
{

    use mailHelper;
    use jwtHelper;
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['jwt.verify', 'verifyToken'], ['except' => ['firstRegistration', 'login', 'verifyUser', 'forgotPassword', 'resetPassword']]);
    }

    public function firstRegistration(RegistrationFormRequest $request)
    {
      try {
        $validator = Validator::make($request->all(), [
          'name' => 'required|regex:/^([a-zA-Z ]{3,})+$/|unique:guest_houses',
          'city' => 'required|regex:/^([a-zA-Z]{3,})+$/',
          'sector' => 'required|regex:/^([a-zA-Z]{3,})+$/',
          'slogan' => 'regex:/^([a-zA-Z ]{3,})+$/',
          'logo' => 'max:10000|mimes:png,svg'
        ]);
  
      if ($validator->fails()) {
          return ResponseHandler::errorResponse(
            $validator->errors(),
            Response::HTTP_BAD_REQUEST
          );
        }
      $guestHouse = GuestHouse::create([
          'name' => $request->name,
          'slogan' => $request->slogan,
          'logo' => $request->file('logo')->getRealPath(),
          'location' => $request->city."-".$request->sector
      ]);
      cloudinary()->upload($request->file('logo')->getRealPath())->getSecurePath();
      
          $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'guest_house_fk' => $guestHouse->id,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'role' => 'ADMIN',
          ]);
        $verification_code = auth()->login($user);
        DB::table('user_verifications')->insert([
          'user_id' => $user->id,
          'token' => $verification_code
        ]);
        event(new Registered($user, $verification_code));
          return ResponseHandler::successResponse(
              'Well done, you successfully registered your guesthouse as an admin; verify your account and wait patiently for our response, if your guest house has been approved or rejected, through your email account.', 
              Response::HTTP_CREATED, 
              new UserResource($user), 
              $this->respondWithToken($verification_code)
          );
      } catch(\Swift_TransportException $transportExp) {
        User::where('email', $request->email)->delete();
        GuestHouse::where('name', $request->name)->delete();
        return ResponseHandler::errorResponse(
          $transportExp->getMessage(),
           Response::HTTP_BAD_REQUEST
          );
       }
      
    }


    public function secondRegistration(RegistrationFormRequest $request)
    {
      
      try{
        $user = User::create([
          'firstName' => $request->firstName,
          'lastName' => $request->lastName,
          'username' => $request->username,
          'email' => $request->email,
          'phoneNumber' => $request->phoneNumber,
          'guest_house_fk' => $request->token->guest_house_fk ? $request->token->guest_house_fk : $request->guest_house_fk,
          'gender' => $request->gender,
          'password' => bcrypt($request->password),
          'role' => $request->role,
        ]);
  
        $verification_code = auth()->login($user);
        DB::table('user_verifications')->insert([
          'user_id' => $user->id,
          'token' => $verification_code
        ]);
        event(new Registered($user, $verification_code));
        return ResponseHandler::successResponse(
            'user successfully registed', 
            Response::HTTP_CREATED, 
            new UserResource($user), 
            $this->respondWithToken($verification_code)
        );
     } catch(\Swift_TransportException $transportExp) {
      User::where('email', $email)->delete();
      return ResponseHandler::errorResponse(
        $transportExp->getMessage(),
         Response::HTTP_BAD_REQUEST
        );
     }
    }


    public function verifyUser($verification_code){
      if ($this->expDate($verification_code) > $this->expDate($verification_code)) {
        DB::table('user_verifications')->where('token',$verification_code)->delete();
        return ResponseHandler::errorResponse(
          'verification code has expired',
           Response::HTTP_BAD_REQUEST
          );
      }
    	$check=DB::table('user_verifications')->where('token',$verification_code)->first();
    	if(!is_null($check)){
    		$user=User::find($check->user_id);
    		if($user->is_verified === 1){
    			return ResponseHandler::errorResponse(
            'Account already verified',
            Response::HTTP_BAD_REQUEST
    				);
        }

        $dt = new DateTime();
        $user->update(['is_verified'=>1, 'email_verified_at'=> $dt->format('Y-m-d H:i:s')]);
    		DB::table('user_verifications')->where('token',$verification_code)->delete();
    		return ResponseHandler::successResponse(
    		  'you have successfully verified your email address',
          Response::HTTP_OK,
          null,
          null
        );
    	}

    	return ResponseHandler::errorResponse(
        'verification code is invalid!!',
         Response::HTTP_BAD_REQUEST
        );
    }


    public function login(LoginFormRequest $request)
    {
      $username = $request->username;
      $field = filter_var($username, FILTER_VALIDATE_EMAIL)? 'email': 'username';
      $credentials = [
        $field => $username,
        'password' => $request->password
      ];
      
      
      if (!$token = JWTAuth::attempt($credentials)) {
        return ResponseHandler::errorResponse(
         'Please check if your username or email and password are true',
         Response::HTTP_UNAUTHORIZED
        );
      } 
      $user = User::where($field, $username)->firstOrFail();
          if ($user->role !== 'SUPER_ADMIN') {
            if ($user->guest_houses->status !== 'approved') {
              return ResponseHandler::errorResponse(
                'You can not logged in, yet your guest house has not been approved',
                Response::HTTP_UNAUTHORIZED
            );
            }
          }
        
            return ResponseHandler::successResponse(
              'user successfully logged in',
               Response::HTTP_OK,
               null,
               $this->respondWithToken($token)
            );
      }


    public function forgotPassword(ForgotPasswordRequest $request) {
      try {
      $input = $request->only('email');
      $user = User::where('email', $input)->firstOrFail();
      $reset_code = JWTAuth::fromUser($user);
      DB::table('password_resets')->insert([
        'email' => $input['email'],
        'token' => $reset_code
      ]);
      event(new ForgetPassword($user, $reset_code));
      return ResponseHandler::successResponse(
        'reset mail sent successfully',
         Response::HTTP_OK,
         null,
         null
      );
    } catch(\Swift_TransportException $transportExp) {
      DB::table('password_resets')->where('email', $input['email'])->delete();
      return ResponseHandler::errorResponse(
        $transportExp->getMessage(),
         Response::HTTP_BAD_REQUEST
        );
     }
    }


    public function resetPassword(ResetPasswordRequest $request, $reset_code) {
      if ($this->expDate($reset_code) > $this->expDate($reset_code)) {
        return ResponseHandler::errorResponse(
          'reset code has expired',
           Response::HTTP_BAD_REQUEST
          );
      }

      $check = DB::table('password_resets')->where('token', $reset_code)->first();
      if (!is_null($check)) {
        $user = User::where('email', $check->email)->firstOrFail();
        User::where('id', $user->id)
          ->update(['password' => bcrypt($request->password)]);
          DB::table('password_resets')->where('token', $reset_code)->delete();
        return ResponseHandler::successResponse(
    		  'you have successfully reseted your password address',
          Response::HTTP_OK,
          null,
          null
        );
      }
      return ResponseHandler::errorResponse(
        'reset code is invalid!!',
         Response::HTTP_BAD_REQUEST
        );
    }


    public function getAuthUser(Request $request)
    {
        return ResponseHandler::successResponse(
    		  'User successfully returned',
          Response::HTTP_OK,
          new UserGetOneResource(auth()->user()),
          null
        );
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(
          ['message'=>'Successfully logged out']);
    }


    protected function respondWithToken($token)
    {
        return $token;
    }
}
