<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\TeamMemberModel;
use App\Models\TeamModel;
use App\Models\TopicModel;
use Illuminate\Support\Facades\DB;

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
        $data["open_book_count"] = DB::table('book')
            ->where('owned_by', session('user_id'))
            ->where('status', 1)
            ->where('deleted', 0)
            ->count();
        $data["complete_book_count"] = DB::table('book')
            ->where('owned_by', session('user_id'))
            ->where('status', 2)
            ->where('deleted', 0)
            ->count();
        $data["transferred_book_count"] = DB::table('book')
            ->where('created_by', session('user_id'))
            ->where('owned_by', "!=", session('user_id'))
            ->where('deleted', 0)
            ->count();
        $data["team_count"] = DB::table('team')
            ->where('leader_id', session('user_id'))
            ->where('status', 1)
            ->where('deleted', 0)
            ->count();

        $data["books"] = BookModel::Where([["created_by", session('user_id')], ["deleted", 0]])->get();
        if ($data["books"] == [])
            unset($data["books"]);

        session(['book' => $data]);

        return view('dashboard', ["data" => $data]);
    }

    public function view_teams()
    {
        /* $data = TeamModel::Where([["deleted", 0], ["status", 1]])->get(); */
        $data = TeamModel::whereHas('members', function ($query) {
            $query->where([['user_id', session('user_id')], ['request_accepted', 1]]);
        })->get();


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
