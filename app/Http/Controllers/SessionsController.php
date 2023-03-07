<?php

namespace App\Http\Controllers;


class SessionsController extends Controller
{

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(! auth()->attempt($attributes)){
            return back()
                ->withInput()
                ->withErrors(['email'=>'Your provided credentials could not be verified.']);
        }
        session()->regenerate();
        return redirect('/')->with('success','Welcome Back!');


    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success','Goodbye!');
    }

    public function create()
    {
        return view('sessions.create');
    }
}
