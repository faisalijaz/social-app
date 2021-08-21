<?php

namespace App\Repositories\PostComment;

use App\Models\PostComment;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentPostComment extends EloquentRepository implements BaseRepository, PostCommentRepository
{
    protected $model;

    /**
     * @param PostComment $postComment
     */
    public function __construct(PostComment $postComment)
    {
        $this->model = $postComment;
    }
}
