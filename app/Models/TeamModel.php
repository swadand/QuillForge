<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamModel extends Model
{
    use HasFactory;

    protected $table = "team";
    public $timestamps = false;

    protected $fillable = [
        'team_name',
        'description',
        'status',
        'leader_id',
        'team_id',
        'password',
        'created_at',
        'deleted',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(UserModel::class, 'leader_id', 'id');
    }

}
