<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\CommentRequest;
use App\Http\Traits\FileUploadTrait;
use App\Services\Admin\CommentService;
use App\Services\UserService;

class OrderCommentController extends Controller
{
    use FileUploadTrait;

    public function __construct(public CommentService $commentService, public UserService $userService) {}

    public function send_comment(int $id, CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['order_id'] = $id;
        if ($request->hasFile('file')) $data['file'] = $this->fileUpload($request->file('file'), 'comments');
        $comment = $this->commentService->create($data);
        $users = $this->userService->getCommentSendedUsers(['admin', 'operator']);
        $this->commentService->send_other_users($comment, $users);
        return response([
            'status' => 'success',
            'message' => 'Komment əlavə olundu',
            'data' => [
                'text' => $comment->text,
                'user' => $comment->user->name,
                'time' => $comment->created_at->format('d.m.Y H:i'),
            ],
        ]);
    }
}
