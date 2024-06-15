<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeamMemberModel extends Model
{
    use HasFactory;

    protected $table = "team_member";
    public $timestamps = false;

    protected $fillable = [
        "team_id",
        "user_id",
        "kicked",
        "role",
        "request_accepted",
    ];

    public function member(): HasOne
    {
        return $this->HasOne(UserModel::class, "user_id", "id");
    }

    public function team(): HasOne
    {
        return $this->HasOne(TeamModel::class, "team_id", "id");
    }
}
