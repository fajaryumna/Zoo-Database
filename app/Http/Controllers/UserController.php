<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{

    // public function login(Request $req)
    // {
    //     $username = $req->input('username');
    //     $password = $req->input('password');

    //     $checkLogin = DB::table('user')->where(['username'=>$username,'password'=>$password])->get();
    //     if(count($checkLogin)  > 0){
    //         return redirect('/zoo');
    //     }
    //     else{
    //         return redirect('/');
    //     }
    // }

    // public function login()
    // {
    //     if (Auth::check()) {
    //         return redirect('/zoo');
    //     }else{
    //         return view('/login');
    //     }
    // }

    // public function actionlogin(Request $request)
    // {
    //     $data = [
    //         'username' => $request->input('username'),
    //         'password' => $request->input('password'),
    //     ];

    //     if (Auth::Attempt($data)) {
    //         return redirect('/zoo');
    //     }else{
    //         Session::flash('error', 'Email atau Password Salah');
    //         return redirect('/login');
    //     }
    // }

    // public function actionlogout()
    // {
    //     Auth::logout();
    //     return redirect('/');
    // }
}