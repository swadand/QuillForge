<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function leader(): BelongsTo
    {
        return $this->BelongsTo(UserModel::class, 'leader_id', 'id');
    }

    public function members(): HasMany
    {
        return $this->HasMany(TeamMemberModel::class, 'team_id', 'id');
    }

    public function topics(): HasMany
    {
        return $this->HasMany(TopicModel::class, 'team_id', 'id');
    }
}
