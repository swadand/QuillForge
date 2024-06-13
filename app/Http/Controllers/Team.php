<?php

namespace App\Http\Controllers;

use App\Models\TeamModel;
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

            $flag = TeamModel::Create($team_row);

            if ($flag == "") {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'error' => ['Could not create Team.'],
                ]);
                throw $error;
            } else {
                return redirect('u/teams');
            }
        }
    }
}
