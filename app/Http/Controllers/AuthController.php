<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    //
    public $authService;

    public function __construct(AuthService $authService){

        $this->authService = $authService;
    }

    public function Register(Request $request){

        $validator=Validator::make($request->all(),[
            "email"=>[
                "required",
                "email",
                "unique:users,email"
            ],
            "password"=>[
                "required",
                "min:10"
            ]
        ],[]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        return $this->authService->Register($request);
    




    }

    public function Login(Request $request){

        return $this->authService->Login($request);


    }
    public function Logout(Request $request){

        $token=$request->header("Authorization");
        $tk=explode("|",$token);
        $tk=$tk[1];

        $tokenRow=PersonalAccessToken::where("token",hash("sha256",$tk))->first();

        $tokenRow->delete();

        return Response()->json(["logout"=>"success"]);




       

    }
}
