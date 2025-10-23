<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRead extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'comment_id',
        'user_id',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
