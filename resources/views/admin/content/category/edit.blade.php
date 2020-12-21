@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Category Edit</h1>
        </div>
        <div class="card-body">
            {!! Form::model($category, ['route' => ['admin.content.category.update', ['locale'=>app()->getLocale(),'category' =>$category]], 'method' => 'patch']) !!}
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', $category->name,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <strong>In Menu:</strong>
                <label><input type="checkbox" name="in_menu" @if ($category->in_menu) checked @endif></label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
