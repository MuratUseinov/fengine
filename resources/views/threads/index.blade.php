@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum Threads</div>

                    <div class="card-body">
                        @foreach($threads as $thread)
                            <article>
                                <h4>
                                    <a href=""> {{ $thread->creator->name }}</a> posted:
                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                </h4>
                                <div class="body">{{ $thread->body }}</div>
                                <hr>
                            </article>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="/threads">
                    {{ csrf_field() }}
                    <input type="text" name="title"/>
                    <input type="text" name="channel_id" value="1"/>
                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-submit">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
