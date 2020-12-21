@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">New Article</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->status }}</td>
                    <td><a href="#">translate</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
