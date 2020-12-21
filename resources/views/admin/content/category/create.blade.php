@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">New Category</h2>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => ['admin.content.category.store',app()->getLocale()], 'method' => 'post']) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('in_menu', '1', null,  ['id' => 'in_menu']) !!}
                        In Menu
                    </label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
