<?php 
namespace App\Helper;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use Illuminate\Support\Facades\Validator;
class UpdateValidationHelper {
    
    protected $request;
    protected $param;

    public function __construct($request, $param) {
        $this->request = $request;
        $this->param = $param;
    }

    public function validate() {
        $validator = Validator::make($this->request->only('username', 'password'), [
            'username' => 'regex:/^([a-zA-Z0-9@_.-]{3,})+$/|unique:users',
            'password' => 'string|min:6|max:10',
        ]);

        if ($validator->fails()) {
            return ResponseHandler::errorResponse(
                $validator->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}