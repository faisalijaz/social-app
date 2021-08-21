@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="card-header">
            <div class="col-sm-6 text-left">
                {{ __('Update Post') }}
            </div>
        </div>

        <div class="card-body">
            <div class="text-right">
                <a href="{{route('post.show', ['id' => $post->id])}}" class="btn btn-success mb-2 ">view post</a>
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

            {!!  Form::open(['url' => route('post.update', ['id' => $post->id]),'method' =>'post', "enctype"=> "multipart/form-data",'class' => 'form-horizontal']) !!}

            {!! Form::token() !!}
            {{ method_field('put') }}
            <div class="form-group">
                {!! Form::label('title', __('Title:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('short_description', __('Short Description:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('short_description', $post->short_description, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', __('Description:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', $post->description, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="form-group">
                <img src="{!! \App\Helpers\ImageHelper::getImageUrl($post->image) !!}"
                     class="profile-photo-edit">
                {!! Form::label('image', __('Upload Image:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('upload_image') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> {{ __('Update Post') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
