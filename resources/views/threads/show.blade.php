@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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
            <hr>
            <h4>Replies</h4>

            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach

            {{ $replies->links() }}

            @if(auth()->check())

                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                    <textarea name="body" id="body" cols="30" rows="5" class="form-control"></textarea>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            @else
                <p>Please sign in.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
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
    </div>
@endsection
