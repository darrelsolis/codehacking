@extends('layouts.admin')

@section('content')
    <h1>Media</h1>
    @if ($photos)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td><img height="50" src="{{ $photo->file }}" alt="{{ $photo->id }}"></td>
                    <td>{{ $photo->created_at ? $photo->created_at : 'No date' }}</td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'action' => ['AdminMediasController@destroy', $photo->id]
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
