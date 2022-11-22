<?php

namespace App\Http\Controllers;

use App\Mail\LoginMail;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index(Request $request){
        if ($request->session()->get('user_id')) {
            return redirect()->to('dashboard')->with('warning','you are already logged in');
        }
        return view('web.pages.auth.login');
    }


    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email',$email)->first();
        if ($user) {
            if (Hash::check($password,$user->password)) {
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_name',$user->name);
                $request->session()->put('user_email',$user->email);
                // $mailData = [
                //     'title' => 'Mail from ItSolutionStuff.com',
                //     'body' => 'This is for testing email using smtp.'
                // ];

                // Mail::to('sunnymollick72@gmail.com')->send(new LoginMail($mailData));
                return redirect()->to('/dashboard')->with('success','Welcome to dashboard');
            }else{
                return back()->with('error','Password is incorrect');
            }
        }else{
            return back()->with('error','Email is not exist');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/')->with('success','Successfully logged out');

    }
}
