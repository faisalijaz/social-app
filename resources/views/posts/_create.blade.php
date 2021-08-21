@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="card-header">
            <div class="col-sm-6 text-left">
                {{ __('Create Post') }}
            </div>
        </div>

        <div class="card-body">

            {!!  Form::open(['url' => route('post.store'),'method' =>'post', "enctype"=> "multipart/form-data",'class' => 'form-horizontal']) !!}

            {!! Form::token() !!}

            <div class="form-group">
                {!! Form::label('title', __('Title:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', $value = null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('short_description', __('Short Description:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('short_description', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', __('Description:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', $value = null, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('image', __('Upload Image:'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('upload_image') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ __('Create Post') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
