@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>

    <div class="row">
        <div class="col-sm-6">
            {!! Form::open([
              'method' => 'POST',
              'action' => 'AdminCategoriesController@store'
            ]) !!}

              <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
              </div>

              {!! Form::submit('Add Category', ['class' => 'btn btn-primary form-control']) !!}

            {!! Form::close() !!}
        </div>

        <div class="col-sm-6">
            @if ($categories)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a></td>
                                <td>
                                    {!! Form::open([
                                      'method' => 'DELETE',
                                      'action' => ['AdminCategoriesController@destroy', $category->id]
                                    ]) !!}

                                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
