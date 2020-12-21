@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">New Article</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.content.article.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lead">Lead</label>
                        <textarea name="lead" id="lead" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
