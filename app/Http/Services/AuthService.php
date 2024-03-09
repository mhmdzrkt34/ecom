<?php

namespace App\Http\Services;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthService {


    public function Register(Request $request){

        try{


        $data=$request->all();
        $data['password']=Hash::make($data['password']);
        $data['role_id']=Role::where("name","admin")->first()['id'];

        $user=User::create($data);

        return Response()->json(["message"=>"success"]);


        }catch(Exception $e){

            return Response()->json(['register failed']);


        }

        







    }
    public function Login(Request $request){

        try {
        $user=User::where('email',$request->input("email"))->first();


        if($user){

            if(Hash::check($request->input("password"),$user->password)){


                $token=$user->createToken("user-token")->plainTextToken;

                return Response()->json(['token'=>$token]);
            }


        }
        return Response()->json(['error'=> 'invalid email or password']);
    }catch(Exception $e){

        return Response()->json("error logining");


    }




        
    }


}



?>