<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $model = new Registration();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->save();
        return view('login');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $data = Registration::where('email','=',$email)->first();
        if($data == null){
            return view('login')->with('info', 'You haven\'t resistered');
        }
        else{
            if(Hash::check($password, $data->password)){
                session(['email'=>$data->email]);
                session(['name'=>$data->name]);
                return view('home');
            }
            else{
                return view('login')->with('info', 'Wrong password');
            }
        }
    }

    public function homeView(){
        return view('home');
    }
}
