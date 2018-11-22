@extends('layouts.admin')

@section('content')
    <h1>My Posts</h1>
    @if ($posts)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img height="75" src="{{ $post->photo ? $post->photo->file : '/images/placeholder-posts.jpg' }}"></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a></td>
                        <td>
                            {!! Form::open([
                              'method' => 'DELETE',
                              'action' => ['AdminPostsController@destroy', $post->id]
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
