<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validations\CreatePostRequest;
use App\Http\Requests\Validations\UpdatePostRequest;
use App\Repositories\Post\PostRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{

    private $post;

    /**
     * construct
     */
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Show all posts
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = $this->post->all();

        return view('posts._index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->find($id);

        return view('posts._show', compact('post'));
    }

    /**
     *
     * Post create - Form
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts._create', []);
    }

    /**
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request)
    {
        $post = $this->post->store($request);

        if (is_null($post) or !$post) {
            return back()->with('error', trans('messages.failed', []));
        }

        return redirect()->route('posts')->with('success', "Post created!");
    }

    /**
     *
     * Post create - Form
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        if (is_null($post) or !$post)
            return back()->with('error', "Post not found!");

        return view('posts._edit', compact('post'));
    }

    /**
     * @param CreatePostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $this->post->update($request, $id);

        return back()->with('success', "Post updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->post->destroy($id);

        return redirect()->route('posts')->with('success', "Post deleted!");
    }

}
