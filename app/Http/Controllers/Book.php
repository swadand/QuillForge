<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Book extends Controller
{
    public function show(Request $request)
    {
        $id = $request->input('id');
        $book_row = BookModel::Where([['book_id', $id], ['owned_by', session('user_id')]])->first();

        if ($book_row != "")
            return response(["statusCode" => 200, "data" => $book_row]);
        else
            return response(["statusCode" => 400, "msg" => "Book not found."]);
    }

    public function view_books()
    {
        $books['open'] = BookModel::Where([["status", 1], ['deleted', 0]])->get();
        $books['completed'] = BookModel::Where([["status", 2], ['deleted', 0]])->get();
        $books['closed'] = BookModel::Where([["status", 0], ['deleted', 0]])->get();

        $_SESSION["books"] = $books;
        return view('books', ["data" => $books]);
    }

    public function update(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');
        $book_row["title"] = $request->input('title');
        $book_row["description"] = $request->input('description');

        $book_row = BookModel::Where([['id', $id], ['owned_by', session('user_id')]])->update($book_row);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not update."]);
        else
            return response(["statusCode" => 200, "msg" => "Book updated"]);
    }

    public function forfeit(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');

        $book_row = BookModel::Where([['book_id', $id], ['owned_by', session('user_id')]])->update(["status" => 0]);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not update."]);
        else
            return response(["statusCode" => 200, "msg" => "Book updated"]);
    }

    public function complete(Request $request)
    {
        $book_row = [];
        $id = $request->input('id');

        $book_row = BookModel::Where([['book_id', $id], ['owned_by', session('user_id')]])->update(["status" => 2]);

        if ($book_row == 0)
            return response(["statusCode" => 400, "msg" => "Could not update."]);
        else
            return response(["statusCode" => 200, "msg" => "Book updated"]);
    }

    public function new_book()
    {
        $book_row = [
            "title" => "New Book",
            "book_id" => Str::random(4) . Str::random(3),
            "content" => "Write something special...",
            "created_by" => session('user_id'),
            "owned_by" => session('user_id'),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $flag = BookModel::Create($book_row);

        if ($flag != "")
            return redirect('u/editor/b/' . $book_row["book_id"]);
    }

    public function view_book(string $book_id)
    {
        $book_row = BookModel::Where([['book_id', $book_id], ['owned_by', session('user_id')]])->first();

        if ($book_row == "") {
            $team_flag = DB::table('topic as t')
                ->select('b.id', 'b.title', 'b.content', 'b.owned_by')
                ->join('book as b', 't.book_id', '=', 'b.id')
                ->join('team_member as tm', 't.team_id', '=', 'tm.team_id')
                ->where('b.book_id', $book_id)
                ->groupBy('b.id')
                ->get();

            if (is_array($team_flag) && empty($team_flag))
                return view('editor', ["content" => $team_flag["content"], "owned_by" => $team_flag["owned_by"], "status" => $book_row["status"]]);
            else
                abort(404);
        } else {
            return view('editor', ["content" => $book_row["content"], "title" => $book_row["title"], "owned_by" => $book_row["owned_by"], "status" => $book_row["status"]]);
        }
    }

    public function save_book_content(Request $request)
    {
        $content = $request->input("content");

        $prev = explode('/', session('_previous')["url"]);
        $book_id = end($prev);
        $flag = BookModel::Where([['book_id', $book_id], ['owned_by', session('user_id')]])->update(["content" => $content]);

        //session(['book' => $book_row]);
        if ($flag == 0)
            return response(["statusCode" => 400]);
        else
            return response(["statusCode" => 200, "msg" => "Book Updated"]);
    }

    public function delete_book(string $book_id)
    {
        $flag = BookModel::Where([['book_id', $book_id], ['owned_by', session('user_id')]])->update(["deleted" => 1]);

        //session(['book' => $book_row]);
        if ($flag == 0)
            return response(["statusCode" => 400]);
        else
            return response(["statusCode" => 200, "msg" => "Book Deleted"]);
    }
}
