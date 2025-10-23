<?php

namespace App\Services\Admin;

use App\Models\Comment;
use App\Models\Order;
use App\Services\MainService;

class CommentService extends MainService
{
    protected $model = Comment::class;

    public function send_other_users(Comment $comment, $users)
    {
        foreach ($users as $user) {
            $comment->reads()->create([
                'user_id' => $user->id
            ]);
        }
    }

    public function read_comments(Order $order)
    {
        $comments = $order->comments;
        foreach ($comments as $comment) {
            $comment_read = $comment->reads()->where('user_id', auth()->id())->first();
            if (!is_null($comment_read)) {
                $comment_read->update([
                    'status' => 1
                ]);
            }
        }
    }
}
