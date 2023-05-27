<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function forgotpassword()
    {
        return view('user.forgotpassword');
    }

    public function newUser(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password' => 'required|confirmed', 
        ]);

        // User::create($request->all());

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

        return redirect()->route('verification.notice');
    
        event(new Registered($user));

        // if ($user->role === 'staff') {
        //     return redirect()->route('verification.notice');
        // } else {
        //     // return redirect()->route('admin.dashboard')->with('message', "user created");
        // }
        
    }
}
