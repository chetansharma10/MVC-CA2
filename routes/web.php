<?php
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


Route::get('/', function () {
    if(session()->has("verifiedUser")){
        if(session()->get("verifiedUser")){
            return view("welcome");
        }
        else{
            return redirect("/login");
        }
    }
    else{
        return redirect("/login");
    }
});


Route::get('/login', function () {
    return view('login');
});



Route::get('/signup', function () {
    return view('signup');
});





// Languages Routes By Localization
Route::get("/{lang}",function($lang){
    App::setLocale($lang);
    return view("welcome");
});

Route::get("/{lang}/login",function($lang){
    App::setLocale($lang);
    return view("login");
});

Route::get("/{lang}/signup",function($lang){
    App::setLocale($lang);
    return view("signup");
});






Route::get('/verifyAccount', function (Request $req ) {
    $email=$req->input("email");
    $activationCode=$req->input("activationCode");
    $result=DB::select('select * from Employees where email = ? && activationCode =?', [$email,$activationCode]);
    if(count($result)>0){
        DB::update('update Employees set verified = ? where email=? && activationCode=?', [1,$email,$activationCode]);
        return view("login",["verified"=>true]);
    }
});


Route::post("/logNow",[Users::class,"logNow"]);
Route::get("/logOutNow",[Users::class,"logoutNow"]);
Route::post("/signUpNow",[Users::class,"signUpNow"]);
