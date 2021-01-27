<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class UserController extends Controller
{
    public function signup(Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:45',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:45'
            ]);
            if ($validator->fails()) {
                $errors = ($validator->errors()->all());
                return response()->json(['status'=> 'false' , 'message' =>$errors, 'data'=>[]],422);
               // dd($errors);
            }
            else
            {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>Hash::make($request->password)
                ]);

               return  response()->json(['status'=> 'true' , 'message' =>"Account created successfully", 'data'=>[]],500); 
            }
        } catch (\Exception $e) {
           return response()->json(['status'=> 'false' , 'message' =>$e->getMessage(), 'data'=>[]],500); 
        }

    }
}
