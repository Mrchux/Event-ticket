@extends('layouts.app')

@section('title')
    @if($post)
        {{ $post->title }}
        @if(!Auth::guest() && ($post->user_id == Auth::user()->id ))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
@endsection

@section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->user_id)}}">{{ $post->author->name }}</a></p>
@endsection

@section('content')
        <div class="col-md-6 col-md-offset-3">
            @if($post)
            <div>
                <h2> {!! $post->title !!}</h2>
            </div>
            <div>
                {!! $post->content !!}
            </div>
            <div>
                <h2>Leave a comment</h2>
            </div>
            @if(Auth::guest())
                <p>Login to Comment</p>
            @else
                <div class="panel-body">
                    <form method="post" action="/comment/add">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="on_post" value="{{ $post->id }}">
                        <input type="hidden" name="slug" value="{{ $post->slug }}">
                        <div class="form-group">
                            <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
                        </div>
                        <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                    </form>
                </div>
            @endif

            @else
                404 error
            @endif
        </div>


@endsection