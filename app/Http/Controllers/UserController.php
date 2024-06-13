<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function register(Request $request): RedirectResponse
    {
        $flag = $request->validate([
            "first-name" => ['required', 'min:2', 'max:10'],
            "last-name" => ['nullable', 'max:10'],
            "email" => ['required', 'max:25'],
            "password" => ['required', 'max:25'],
        ]);

        $first_name = $request->input('first-name');
        $last_name = $request->input('last-name');
        $email = $request->input('email');
        $password = $request->input('password');

        $hash = hash("sha256", (string)$password);

        $user_row = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "password" => $hash,
        ];

        $flag = UserModel::create($user_row);

        return redirect('u/dashboard');
    }

    public function validate_login(Request $request)
    {
        $flag = $request->validate([
            "email" => ['required', 'max:25'],
            "password" => ['required', 'max:25'],
        ]);

        $user_data = $request->input();

        $hashed = hash("sha256", $user_data["password"]);
        $user = UserModel::where([["email", $user_data["email"]], ["password", $hashed], ["deleted", 0]])->first();

        if($user == "") {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'password' => ['Wrong Email or password'],
            ]);
            throw $error;
        } else {
            if($user["status"] == 0) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'password' => ['Account Deactivated, Contact Support.'],
                ]);
            }
            session(["user_id" => $user["id"]]);
            session(["user_name" => $user["last_name"] == null ? $user["first_name"] : $user["first_name"] . " " . $user["last_name"]]);

            return redirect('u/dashboard');
        }
    }
}
