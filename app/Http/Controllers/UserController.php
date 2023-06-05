<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function forgotpassword()
    {
        return view('user.forgotpassword');
    }

    public function passwordResetEmail()
    {
        return view('email.resetpasswordmail');
    }

    public function registerUser(Request $request)
    {
            
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password' => 'required|confirmed', 
        ]);

        // User::create($request->all());

        // dd($request ->all());
        try {
            // Insert the data into the database
            $user = new User;
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role = $request->input('role','staff');
            $user->save();

          
        } catch (QueryException $e) {
            if ($e->getCode() === '23000' && $e->errorInfo[1] === 1062) {
                // Handle the duplicate entry error
                return redirect()->back()->withErrors(['email' => 'The email address is already taken.'])->withInput();
            }
        }

        return redirect()->route('user.login')->with('message','User created.');
    
        event(new Registered($user));

        // if ($user->role === 'staff') {
        //     return redirect()->route('verification.notice');
        // } else {
        //     // return redirect()->route('admin.dashboard')->with('message', "user created");
        // }
        
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $remember = $request->filled('rememberCheck');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
 
            $user = Auth::user();
            
            if(auth()->user()->role == "admin" ){

                return view('dashboard', compact('user'));

            }else{
                return Redirect::route('staff.home')->with(compact('user'));
            }
          
            
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }

    public function sendPasswordResetEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Generate and store password reset token
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);
            
            
            // Send password reset email
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
    
            return back()->with('message', 'Password reset email sent.');
        }
    
        return back()->withErrors(['email' => 'Email not found.']);
    }

    public function resetPassword(Request $request)
    {
        # code...
    }

    public function home()
    {
        return view('staff.home');
    }
    
}
