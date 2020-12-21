@extends('layouts.admin')

@section('content')
{{--    <div class="row">--}}
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Categories</h2>
                    <div class="card-tools">
                        <a href="{{ route('admin.content.category.create', app()->getLocale()) }}" class="btn btn-sm btn-outline-success">Add new</a>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>In menu</th>
                            <th>Setup</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><a href="{{ route('admin.content.category.show',['category'=>$category,'locale'=>app()->getlocale()]) }}">{{ $category->name }}</a></td>
                                <td>
                                    <input type="checkbox" class="icheck-primary" name="in_menu" @if($category->in_menu) checked @endif>
                                </td>
                                <td><a href="{{ route('admin.content.category.edit',[app()->getLocale(),$category]) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-tools"></i></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#exampleModal{{$category->id}}">translate</a></td>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        {!! Form::model($category, ['route' => ['admin.content.category.translate', ['category'=>$category,'locale'=>app()->getLocale()]], 'method' => 'post']) !!}
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <strong>Language:</strong>
                                                    <select name="translate-to-locale" id="locale" class="form-control">
                                                        @foreach (config('app.locales') as $localeKey => $locale)
                                                        <option value="{{$localeKey}}">{{ $locale }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <strong>Name:</strong>
                                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

{{--    </div>--}}

@endsection
