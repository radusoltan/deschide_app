@extends('layouts.admin')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Permissions</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('manage.permissions.create') }}"> Create New Permission</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Guard</th>
{{--                        <th>Roles</th>--}}
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard }}</td>
{{--                            <td>--}}
{{--                                @if(!empty($user->getRoleNames()))--}}
{{--                                    @foreach($user->getRoleNames() as $v)--}}
{{--                                        <label class="badge badge-success">{{ $v }}</label>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td>
                                <a class="btn btn-info" href="{{ route('manage.permissions.show',$permission) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('manage.permissions.edit',$permission) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['manage.permissions.destroy', $permission],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
