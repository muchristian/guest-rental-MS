<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistrationFormRequest;
use App\Http\Requests\LoginFormRequest;
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
        $this->middleware(['jwt.verify', 'verifyToken'], ['except' => ['signup', 'login', 'verifyUser', 'forgotPassword', 'resetPassword']]);
    }

    public function signup(RegistrationFormRequest $request)
    {
      $user = User::create([
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'username' => $request->username,
        'email' => $request->email,
        'phoneNumber' => $request->phoneNumber,
        'gender' => $request->gender,
        'password' => bcrypt($request->password),
        'role' => $request->role,
      ]);

      $verification_code = auth()->login($user);
      DB::table('user_verifications')->insert([
        'user_id' => $user->id,
        'token' => $verification_code
      ]);
      $firstname = $request->firstName;
      $lastname = $request->lastname;
      $email = $request->email;
      $this->sendMail('email.verify',
      $firstname, 
      $email, 
      'verification_code', 
      $verification_code);
      return ResponseHandler::successResponse(
          'user successfully registed', 
          Response::HTTP_CREATED, 
          $user, 
          $this->respondWithToken($verification_code)
      );
    }

    public function verifyUser($verification_code){
      if ($this->expDate($reset_code) > $this->expDate($reset_code)) {
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
        $unix = JWTAuth::getPayload($check->token)->get('exp');
        $date = date('H:i:s', $unix);
        $curr = new DateTime($date);
        $curr->add(new DateInterval('PT1H60M'));
        $output = $curr->format('Y-m-d H:i:s');
        
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
      } else {
        $user = User::where($field, $username)->first();
        if ($user->is_verified !== 1) {
            return ResponseHandler::errorResponse(
                'check if you have verified your email',
                Response::HTTP_UNAUTHORIZED
            );
          }
            return ResponseHandler::successResponse(
              'user successfully logged in',
               Response::HTTP_OK,
               null,
               $this->respondWithToken($token)
            );
      }
    }

    public function forgotPassword(Request $request) {
      $input = $request->only('email');
      $user = User::where('email', $input)->first();
      if (!$user) {
        return ResponseHandler::errorResponse(
          'check if your email is registed',
          Response::HTTP_BAD_REQUEST
      );
      }
      $reset_code = JWTAuth::fromUser($user);
      DB::table('password_resets')->insert([
        'email' => $input['email'],
        'token' => $reset_code
      ]);
      $this->sendMail('password.forgot_password',
      $user->firstName, 
      $input['email'], 
      'reset_code', 
      $reset_code);
      return ResponseHandler::successResponse(
        'reset mail sent successfully',
         Response::HTTP_OK,
         null,
         null
      );
    }

    public function resetPassword(Request $request, $reset_code) {
      if ($this->expDate($reset_code) > $this->expDate($reset_code)) {
        return ResponseHandler::errorResponse(
          'reset code has expired',
           Response::HTTP_BAD_REQUEST
          );
      }
      $check = DB::table('password_resets')->where('token', $reset_code)->first();
      if (!is_null($check)) {
        $user = User::where('email', $check->email)->first();
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
        return auth()->user();
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
