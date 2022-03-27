<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
class Users extends Controller
{
    //Users Controller
    function logNow(Request $req){
        $email=$req->input("email");
        $password=$req->input("password");

        $validator=Validator::make($req->all(),[
            "email"=>"required",
            "password"=>"required|min:8",
        ]);
        $errors=$validator->errors();
        if(count($errors)>0){
            return view("login",["errors"=>$errors]);
        }
        else{
            $result=DB::select('select * from Employees where email = ? && password =?', [$email,$password]);
            if($result[0]->verified){
                session()->put("verifiedUser",true);   
                return redirect("/");
            }           
            else{
                return view("login",["verified"=>false]);
            }

        }

    }

    function logOutNow(Request $req){
        if(session()->has("verifiedUser")){
            session()->flush();
            return redirect("/login");
        }

    }
    function signUpNow(Request $req){
        $username=$req->input("username");
        $email=$req->input("email");
        $password=$req->input("password");
        $activationCode=bin2hex(random_bytes(16));
        $link="http://".$_SERVER['HTTP_HOST']."/verifyAccount?email=".$email."&activationCode=".$activationCode;
        $validator=Validator::make($req->all(),[
            "username"=>"required|unique:Employees,username",
            "email"=>"required|unique:Employees,email",
            "password"=>"required|min:8",
        ]);
        $errors=$validator->errors();
        if(count($errors)>0){
            return view("signup",["errors"=>$errors]);
        }
        else{

            DB::insert('insert into Employees (username,email,password,activationCode) values (?, ?,?,?)',
             [$username,$email,$password,$activationCode]);
             $details=[
                        "title"=>"Email Verification Required",
                        "body"=>"Hi,User ".$username." We are very thankfull to you for visiting our website.To complete all verification from our side just click on verification link.".$link
                    ];
            Mail::to($email)->send(new TestMail($details));
            return view("login",["done"=>200]);
        }
       
        


        








    }
    
}
