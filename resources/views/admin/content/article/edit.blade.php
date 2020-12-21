@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.content.article.update',$article) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') ?? $article->title }}">
                </div>
                <div class="form-group">
                    <label for="lead">Lead</label>
                    <textarea name="lead" id="lead" cols="30" rows="10">{{ old('lead') ?? $article->lead}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10">{{ old('content') ?? $article->content}}</textarea>
                </div>
                <button class="btn btn-sm btn-success" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
