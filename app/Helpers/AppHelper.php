<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\User;

class AppHelper
{
    /**
     * @return mixed
     */
    public static function getRegisteredUserCount()
    {
        return User::count();
    }

    /**
     * @return mixed
     */
    public static function getPostsCount()
    {
        return Post::count();
    }

    /**
     * @param $id
     * @param $userId
     * @return mixed
     */
    public static function isPostOwner($id, $userId)
    {
        return Post::mine($userId)->byId($id)->exists();
    }

    /**
     * @param $id
     * @param $userId
     * @return mixed
     */
    public static function canModifyPost($id, $userId)
    {
        $post = Post::mine($userId)->byId($id)->first();
        return !(($post && $post->comments_count > 0));
    }
}
