<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'password',
        'login_token',
        'remember_me_token',
        'deleted',
    ];
}
