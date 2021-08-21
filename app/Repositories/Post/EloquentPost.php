<?php

namespace App\Repositories\Post;

use App\Helpers\ImageHelper;
use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EloquentPost extends EloquentRepository implements BaseRepository, PostRepository
{
    protected $model;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * @param int $page
     * @param bool $active
     * @return mixed
     */
    public function allMine($page = 50, $active = true)
    {
        $user = (!is_null(Auth::id())) ? Auth::id() : null;

        return $this->model->mine($user)->active($active)->recent()->paginate($page);
    }

    /**
     * @param int $page
     * @param bool $active
     * @return mixed
     */
    public function all($page = 50, $active = true)
    {
        return $this->model->with('author')->active($active)->recent()->paginate($page);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if ($request->hasFile('upload_image')) {
            $image = ImageHelper::saveImage($request->file('upload_image'));
            if (!is_null($image)) $image = (!is_null($image)) ? $image : "no-image.jpg";
            $request->merge(['image' => $image]);
        }

        $post = parent::store($request);

        return $post;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('upload_image')) {
            $image = ImageHelper::saveImage($request->file('upload_image'));
            if (!is_null($image)) $image = (!is_null($image)) ? $image : "no-image.jpg";
            $request->merge(['image' => $image]);
        }

        $post = parent::update($request, $id);

        return $post;
    }
}
