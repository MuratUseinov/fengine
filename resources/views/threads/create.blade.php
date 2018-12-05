@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new thread</div>
                    <div class="card-body">
                        <form action="/threads" method="POST">
                            <div class="form-group">
                                <label for="title">Choose a Channel:</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="..." selected disabled>...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{ old('title')  }}"required>
                            </div>
                            <div class="form-group">
                                <label for="body">Title:</label>
                                <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Send</button>

                            @if(count($errors))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
