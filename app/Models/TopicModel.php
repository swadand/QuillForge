<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TopicModel extends Model
{
    use HasFactory;

    protected $table = "topic";
    public $timestamps = false;

    protected $fillable = [
        "book_id",
        "title",
        "description",
        "created_by",
        "team_id",
        "created_at",
        "taken_by",
        "taken_at",
        "completed_at",
        "status",
        "deleted",
    ];

    public function book(): HasOne
    {
        return $this->HasOne(BookModel::class, 'book_id', 'book_id');
    }
}
