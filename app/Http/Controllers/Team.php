<?php

namespace App\Http\Controllers;

use App\Models\TeamMemberModel;
use App\Models\TeamModel;
use App\Models\TopicModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class Team extends Controller
{
    public function create(Request $request)
    {
        $flag = $request->validate([
            "team_name" => ['required', 'min:2', 'max:20'],
            "description" => ['nullable', 'max:70'],
            "status" => ['required'],
        ]);

        $team_name = $request->input('team_name');
        $description = $request->input('description');
        $status = $request->input('status');

        $flag = TeamModel::Where("team_name", $team_name)->first();

        if ($flag != null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'name-error' => ['Team Name Taken'],
            ]);
            throw $error;
        } else {
            $team_row = [
                "team_id" => Str::random(6),
                "leader_id" => session('user_id'),
                "team_name" => $team_name,
                "description" => $description,
                "created_at" => Date::today()->toDateString(),
                "status" => $status,
            ];
            $team = TeamModel::Create($team_row);

            $team_member_row = [
                "team_id" => $team->id,
                "user_id" => session('user_id'),
                "kicked" => 0,
                "role" => 1,
                "request_accepted" => 1,
            ];
            $team = TeamMemberModel::Create($team_member_row);

            if ($team == "") {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'error' => ['Could not create Team.'],
                ]);
                throw $error;
            } else {
                return redirect('u/teams');
            }
        }
    }

    public function join(Request $request)
    {
        $flag = $request->validate([
            "team_id" => ['required', 'min:2', 'max:6'],
        ]);

        $team_id = $request->input('team_id');

        $flag = TeamMemberModel::Where([["user_id", session('user_id')], ["team_id", $team_id]])->first();
        $team = TeamModel::Where("team_id", $team_id)->first();

        if ($team == null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'join-error' => ['Invalid Code.'],
            ]);
            throw $error;
        } else if ($flag != null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'join-error' => ['Already Joined.'],
            ]);
            throw $error;
        } else {
            $team_member_row = [
                "team_id" => $team["id"],
                "user_id" => session('user_id'),
                "kicked" => 0,
                "role" => 2,
                "request_accepted" => 0,
            ];
            $team = TeamMemberModel::Create($team_member_row);

            if ($team == "") {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'error' => ['Could not create Team.'],
                ]);
                throw $error;
            } else {
                return redirect('u/teams');
            }
        }
    }

    public function details(string $team)
    {   
        $team = TeamModel::Where('team_name', $team)->first();
        
        if ($team == null) {
            
        } else {
            $request = TeamMemberModel::Where([['team_id', $team["id"]], ["request_accepted", 0], ["deleted", 0]])->get();
            $topic = TopicModel::Where('team_id', $team["id"])->get();

            return view("team-details", ["team" => $team, "request" => $request, "topic" => $topic]);
        }
    }

    public function accept_request(int $team_id, int $user_id)
    {
        $request = TeamMemberModel::Where([['user_id', $user_id], ["team_id", $team_id], ["deleted", 0]])->first();

        $request->request_accepted = 1;

        $request->save();
    }

    public function reject_request(int $team_id, int $user_id)
    {
        $request = TeamMemberModel::Where([['user_id', $user_id], ["team_id", $team_id]])->first();

        $request->deleted = 1;

        $request->save();
    }
}
