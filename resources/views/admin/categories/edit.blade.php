@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>

    <div class="row">
        <div class="col-sm-6">
            {!! Form::model($category, [
              'method' => 'PATCH',
              'action' => ['AdminCategoriesController@update', $category->id]
            ]) !!}

              <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
              </div>

              {!! Form::submit('Update Category', ['class' => 'btn btn-warning form-control']) !!}<br><br>
              <a href="{{ route('categories.index') }}" class='btn btn-info form-control'>Back to Categories</a>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
