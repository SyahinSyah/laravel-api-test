<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Validator;

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
                'email' => 'required|email|unique',
                'password' => 'required|min:8|max:45'
            ]);
            if ($validator->fails()) {
                $errors = ($validator->errors()->all());
                dd($errors);
            }
            else
            {

            }
        } catch (\Exception $e) {
            response()->json(['status'=> 'false' , 'message' =>$e->getMessage(), 'data'=>[]],500); 
        }

    }
}
