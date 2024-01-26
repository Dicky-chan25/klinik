<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register() {
        return view('landing-page.register');
    }

    public function login() {
        return view('landing-page.login');
    }

    public function registerPost(RegisterRequest $req){
        // dd($req->all());
        try {
            //code...
            $req->validated();
            $user = new User();
            $firstName= $req->fname;
            $lastName = $req->lname;
            $userName = $req->username;
            $email = $req->email;
            $password = $req->pwd;
            $repeatPassword = $req->rpwd;
    
            // check match password and repeat password
            if ($password != $repeatPassword) {
                Session::flash('error', 'Password dan Ulangi Password Tidak Sama');
                return back();
            }

            $user->firstname = $firstName;
            $user->lastname = $lastName;
            $user->username = $userName;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->level_id = 2; // this is patient
            $user->save();
            Session::flash('success', 'Register Successfully, Please Login with your Account!');
            return redirect('/login');

        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }


    }

    public function loginPost(LoginRequest $req){
        try {
            // check validation
            $req->validated();
            
            // check credentials
            $credentials = [
                'email' => $req->email,
                'password' => $req->pwd
            ];
            if (Auth::attempt($credentials)) {
                $req->session()->regenerate();
                return redirect()->route('home');
            }

            Session::flash('error', 'Email or Password is Invalid');
            return back();

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            Session::flash('error', 'Something Error, Please Refresh Page');
            return back();
        }
    }

    public function dologin(Request $request) {
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user superadmin
                return redirect()->intended('/superadmin');
            } elseif (auth()->user()->role_id === 2) {
                // jika user pegawai
                return redirect()->intended('/admin');
            } else {
                // jika user pegawai
                return redirect()->intended('/apotek');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
