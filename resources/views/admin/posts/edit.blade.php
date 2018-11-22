@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Edit Post</h1>

        <div class="col-sm-3">
            <img class="img-responsive img-rounded" src="{{ $post->photo ? $post->photo->file : '/images/placeholder-posts.jpg' }}" alt="{{ $post->title }}">
        </div>

        <div class="col-sm-9">
            {!! Form::model($post, [
            'method' => 'PATCH',
            'action' => ['AdminPostsController@update', $post->id],
            'files' => true
            ]) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id', ['' => 'Choose a category'] + $categories,  null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo:') !!}
                    {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Body', 'Body:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Update Post', ['class' => 'btn btn-warning']) !!}

            {!! Form::close() !!}
        </div>
    </div>


    <div class="row">
        @include('partials.form-errors')
    </div>
@endsection
