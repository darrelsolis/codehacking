@extends('layouts.admin')

@section('content')
    <h1>Comments</h1>
    @if ($comments)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Body</th>
                    <th>Author</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <th>{{ $comment->id }}</th>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->email }}</td>
                    <td><a href="{{ route('home.post', $comment->post->id) }}" class="btn btn-info">View Post</a><td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::open([
                              'method' => 'PATCH',
                              'action' => ['PostCommentsController@update', $comment->id]
                            ]) !!}
                              <input type="hidden" name="is_active" value="0">
                              {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}

                            {!! Form::close() !!}
                        @else
                            {!! Form::open([
                              'method' => 'PATCH',
                              'action' => ['PostCommentsController@update', $comment->id]
                            ]) !!}
                              <input type="hidden" name="is_active" value="1">
                              {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}

                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'action' => ['PostCommentsController@destroy', $comment->id]
                        ]) !!}

                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
