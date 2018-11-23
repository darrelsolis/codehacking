@extends('layouts.admin')

@section('content')
    <h1>Replies</h1>
    @if ($replies)
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
                @foreach($replies as $reply)
                <tr>
                    <th>{{ $reply->id }}</th>
                    <td>{{ $reply->body }}</td>
                    <td>{{ $reply->author }}</td>
                    <td>{{ $reply->email }}</td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::open([
                              'method' => 'PATCH',
                              'action' => ['CommentRepliesController@update', $reply->id]
                            ]) !!}
                              <input type="hidden" name="is_active" value="0">
                              {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}

                            {!! Form::close() !!}
                        @else
                            {!! Form::open([
                              'method' => 'PATCH',
                              'action' => ['CommentRepliesController@update', $reply->id]
                            ]) !!}
                              <input type="hidden" name="is_active" value="1">
                              {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}

                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'action' => ['CommentRepliesController@destroy', $reply->id]
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
