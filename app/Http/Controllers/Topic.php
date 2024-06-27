<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\TeamMemberModel;
use App\Models\TeamModel;

use Carbon\Carbon;
use App\Models\TopicModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class Topic extends Controller
{
    public function create(Request $request)
    {
        $flag = $request->validate([
            "title" => ['required', 'min:2', 'max:20'],
            "description" => ['nullable', 'max:70'],
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $team_id = $request->input('team_id');

        $flag = TopicModel::Where([["title", $title], ["team_id", $team_id]])->first();

        if ($flag != null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'name-error' => ['Topic Name Taken'],
            ]);
            throw $error;
        } else {
            $topic = [
                "book_id" => Str::random(7),
                "team_id" => $team_id,
                "title" =>$title, 
                "description" => $description,
                "created_by" => session('user_id'),
                "created_at" => Date::today()->toDateString(),
                "status" => 0,
            ];
            $team = TopicModel::Create($topic);

            $book_row = [
                "title" => "New Book",
                "book_id" => $topic["book_id"],
                "content" => "Write something special...",
                "created_by" => session('user_id'),
                "owned_by" => session('user_id'),
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ];
    
            $flag = BookModel::Create($book_row);

            if ($team == "" || $flag == "") {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'error' => ['Could not create Team.'],
                ]);
                throw $error;
            } else {
                return session('_previous')["url"];
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

    public function take(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');

        $book_row = TopicModel::Where('id', $id)->update(["status" => 1, "taken_by" => session("user_id")]);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not acquire."]);
        else
            return response(["statusCode" => 200, "msg" => "Topic Taken"]);
    }

    public function forfeit(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');

        $book_row = TopicModel::Where('id', $id)->update(["status" => 0, "taken_by" => 0]);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not update."]);
        else
            return response(["statusCode" => 200, "msg" => "Topic updated"]);
    }

    public function complete(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');

        $book_row = TopicModel::Where('id', $id)->update(["status" => 2]);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not update."]);
        else
            return response(["statusCode" => 200, "msg" => "Topic updated"]);
    }
}
