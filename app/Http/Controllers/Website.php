<?php 

namespace App\Http\Controllers;


class Website extends Controller
{
    public function login_page()
    {
        return view("sign-in");
    }

    public function signup_page()
    {
        return view("sign-up");
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function view_teams()
    {
        return view('team');
    }

    public function view_profile()
    {
        return view('profile');
    }

    public function logout()
    {
        return redirect('/');
    }
}