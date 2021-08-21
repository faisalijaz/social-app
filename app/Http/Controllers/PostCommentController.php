<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validations\CreatePostCommentRequest;
use App\Http\Requests\Validations\CreatePostRequest;
use App\Repositories\PostComment\PostCommentRepository;

class PostCommentController extends Controller
{

    private $postComment;

    /**
     * construct
     */
    public function __construct(PostCommentRepository $postComment)
    {
        $this->postComment = $postComment;
    }

    /**
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(CreatePostCommentRequest $request)
    {
        $post = $this->postComment->store($request);

        if (is_null($post) or !$post) {
            return back()->with('error', trans('messages.failed', []));
        }
        return back()->with('success', trans('messages.created', []));
    }
}
