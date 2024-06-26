<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\belongsTo;

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

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function team(): belongsTo
    {
        return $this->belongsTo(TeamModel::class, "id", "team_id");
    }
}
