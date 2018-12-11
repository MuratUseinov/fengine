@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($threads as $thread)
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                        <span style="float: right;">{{ $thread->reply_count }} {{ str_plural('reply', $thread->reply_count) }}</span>
                    </div>

                    <div class="card-body">
                        <article>
                            <a href=""> {{ $thread->creator->name }}</a> posted
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
                <hr>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <a class="btn btn-success" href="/threads/create">Add new</a>
        </div>
    </div>
@endsection
