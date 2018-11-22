@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open([
      'method' => 'POST',
      'action' => 'AdminPostsController@store',
      'files' => true
    ]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', array('' => 'options'), null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

    @include('partials.form-errors')
@endsection
