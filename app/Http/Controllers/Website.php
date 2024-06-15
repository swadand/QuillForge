<?php

namespace App\Http\Controllers;

use App\Models\TeamMemberModel;
use App\Models\TeamModel;

class Website extends Controller
{
    public function login_page()
    {
        if (session("user_id") == null)
            return view("sign-in");
        else
            return redirect('u/dashboard');
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
        $data = TeamModel::Where(["deleted" => 0])->get();

        return view('team', ["data" => $data]);
    }

    public function view_profile()
    {
        return view('profile');
    }

    public function view_editor()
    {
        return view('editor');
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name']);

        return redirect('/');
    }
}
