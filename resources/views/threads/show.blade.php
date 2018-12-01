@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum Threads</div>
                    <div class="card-body">
                        <article>
                            <a href=""> {{ $thread->creator->name }}</a> posted:
                            <h2>{{ $thread->title }}</h2>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <textarea name="body" id="body" cols="30" rows="10"></textarea>
                        <button type="submit" class="btn btn-submit">Send</button>
                    </form>
                </div>
            </div>
        @else
            <p>Please sign in.</p>
        @endif
    </div>
@endsection
