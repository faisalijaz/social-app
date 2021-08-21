@extends('layouts.app')

@section('content')
    <!-- Bootstrap Boilerplate... -->

    <div class="container">

        <div class="row">
            <div class="col-12">
                @if($post->is_post_owner)
                    @if(!$post->comments_count > 0)
                        {!!  Form::open(['url' => route('post.delete', ['id' => $post->id]),'method' =>'post','class' => 'form-horizontal']) !!}
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit"
                                onclick="return confirm('Are you sure?')"
                                class="pull-right btn btn-sm btn-danger post-controls ">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!! Form::close() !!}

                        <a href="{{route('post.edit', ['id' => $post->id])}}"
                           class="pull-right btn btn-sm btn-warning post-controls ">
                            <i class="fa fa-pencil"></i>
                        </a>
                    @endif
                @endif
                <a href="{{route('post.create')}}" class="pull-right btn btn-sm btn-primary post-controls ">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-12">
                <div class="post-content">
                    <div class="post-container">
                        <div id="post-image-container">
                            <img src="{!! \App\Helpers\ImageHelper::getImageUrl($post->image) !!}"
                                 class="post-image">
                        </div>
                        <div id="post-detail-container">
                            <div class="post-detail">
                                <div class="user-info">
                                    <h3><a href="{{route('post.show', ['id' => $post->id])}}"
                                           class="profile-link">{{ $post->title }}</a> <span
                                            class="following"></span></h3>
                                    <h6><a href="#" class="profile-link">{{ $post->author->name }}</a>
                                        <span
                                            class="following"></span></h6>
                                    <p class="text-muted"><i class="fa fa-clock-o"></i> {{$post->created_at}}</p>
                                </div>
                                <div class="user-info text-left">
                                    <a class="btn text-green"><i
                                            class="fa fa-comment"></i> {{$post->comments_count}}
                                    </a>
                                </div>
                                <div class="post-text">
                                    <p>{{$post->description}} <i class="em em-anguished"></i> <i
                                            class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="line-divider"></div>
                        <div class="margin-20px"></div>
                        <div class="post-detail-container">
                            <div class="post-detail">

                                <h5>Comments:</h5>
                                <div class="line-divider"></div>

                                @if(!is_null($post->comments))
                                    @foreach($post->comments as $comment)
                                        <div class="post-comment">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""
                                                 class="profile-photo-sm">
                                            <p>
                                                <a href="#" class="profile-link">{{$comment->author->name}} </a>
                                                <i class="fa fa-comment"></i> {{$comment->comment}}
                                            </p>
                                            <hr/>
                                            <span class="text-muted text-red text-right post-time">
                                                <i class="fa fa-clock"></i> {{$comment->created_at}}
                                            </span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="margin-20px"></div>
                            {!!  Form::open(['url' => route('post.comment'),'method' =>'post','class' => 'form-horizontal']) !!}
                            <div class="post-detail">
                                <div class="form-group">
                                    {!! Form::textarea('comment', null, ['rows' => 3, 'class' => 'form-control']) !!}
                                    {!! Form::hidden('post_id', $post->id, []) !!}
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Post') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
