@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="card">
            <div class="card-header">
                <div class="col-sm-6 text-left">
                    {{ __('Posts') }}
                </div>

            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{route('post.create')}}" class="btn btn-success mb-2 ">Add</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <section class="news pt-0">
                    <div class="container mt-md-5">
                        <h2 class="mx-4 my-0 text-center">Latest Posts</h2>
                        <ul class="row d-lg-flex list-unstyled image-block justify-content-center px-lg-0 mx-lg-0">
                            @if(!is_null($posts))
                                @foreach ($posts as $post)
                                    <li class="col-lg-4 col-md-5 image-block full-width p-3">
                                        <div class="image-block-inner">
                                            <a class="mh-100" href="{{route('post.show', ['id' => $post->id])}}">
                                                <img
                                                    src="{!! \App\Helpers\ImageHelper::getImageUrl($post->image) !!}"
                                                    alt="LunarXP Wins Space Innovator of the Year Award"
                                                    class="img-responsive w-100"></a>
                                            <span class="hp-posts-cat"><i>Author: {{$post->author->name}}</i></span>
                                            <h4 class="mt-3"><a
                                                    href="{{route('post.show', ['id' => $post->id])}}">{{$post->title}}</a>
                                            </h4>
                                            <p class="post-text">{{$post->short_description}}</p>
                                            <!--  <p></p> -->
                                            <a href="{{route('post.show', ['id' => $post->id])}}" class="read-more">Read
                                                more ></a>
                                        </div><!-- .image-block-inner -->
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </section>
                <hr/>
                <div class="pagination">
                    <div id="bottom_navigation" class="text-center">
                        {{ $posts->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
