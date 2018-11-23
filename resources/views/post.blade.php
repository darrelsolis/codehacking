@extends('layouts.blog-post')

@section('content')
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by {{ $post->user->name }}
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : '/images/placeholder-posts.jpg' }}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $post->body }}</p>
    <hr>

    @if (Session::has('comment_submitted'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <em>{{ session('comment_submitted') }}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::has('reply_submitted'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <em>{{ session('reply_submitted') }}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if (Auth::check())
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open([
            'method' => 'POST',
            'action' => 'PostCommentsController@store'
            ]) !!}
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>

                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if (count($comments) > 0)
        @foreach ($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" height="64" src="{{ $comment->photo }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->author }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    {{ $comment->body }}
                    <!-- Nested Reply -->

                    @if (count($comment->replies) > 0)
                        @foreach ($comment->replies as $reply)
                                @if ($reply->is_active == 1)
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" height="64" src="{{ $reply->photo }}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $reply->author }}
                                                <small>{{ $reply->created_at->diffForHumans() }}</small>
                                            </h4>
                                            {{ $reply->body }}
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                    @endif

                    <div class="comment-reply-container">
                        @if (Auth::user())
                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                        @endif
                        <div class="comment-reply">
                            {!! Form::open([
                                'method' => 'POST',
                                'action' => 'CommentRepliesController@createReply'
                            ]) !!}

                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <br>
                                <div class="form-group">
                                    {!! Form::label('body', 'Reply:') !!}
                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>

                                {!! Form::submit('Submit Reply', ['class' => 'btn btn-info']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- End Nested Reply -->
                    <hr>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('scripts')
    <script>
        $(".toggle-reply").click(function() {
            $(this).next().slideToggle("slow");
        });
    </script>
@endsection
