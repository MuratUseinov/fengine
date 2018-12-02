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
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="title">
                            </div>
                            <div class="form-group">
                                <label for="body">Title:</label>
                                <textarea class="form-control" id="body" name="body"></textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
