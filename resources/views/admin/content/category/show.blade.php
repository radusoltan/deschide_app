@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Section {{ $category->name }} article list</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#article-modal">Add new article</button>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>translate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category->articles as $article)
                    <tr>
                        <td>
                            <a href="{{ route('admin.content.article.edit',$article) }}">{{ $article->title }}</a>

                        </td>
                        <td>{{ $article->status }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#translateModal">
                                translate
                            </button>
{{--                            <a href="{{ route('admin.content.article.translate',$article) }}">translate</a>--}}
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="translateModal" tabindex="-1" aria-labelledby="translateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="translateModalLabel">Translate Article</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Actual language: <b>{{ config('translatable.locales')[app()->getLocale()] }}</b></p>
                                    <p>Title: {{ $article->title }}</p>
                                    <div class="form-group">
                                        <select name="lang" id="lang" class="form-control">
                                        @foreach(config('translatable.locales') as $langKey => $lang)
                                            @if(app()->getLocale() !== $langKey)
                                            <option value="{{$langKey}}">{{$lang}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <div class="modal fade" id="article-modal" tabindex="-1" role="dialog" aria-labelledby="article-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.content.article.store',['category'=>$category->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="article_modalLabel">New Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <select name="type" class="form-control">
                                @foreach($article->typeOptions() as $typeOptionKey => $typeOptionValue)
                                    <option value="{{ $typeOptionKey }}" {{ $article->type === $typeOptionValue ? 'selected' : ''}}>{{ $typeOptionValue }}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
