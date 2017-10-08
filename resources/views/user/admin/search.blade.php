@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-capitalize">{{ $action }} User</div>
                <div class="panel-body">
                   <form method="GET" action="{{ url('/admin/user/'.$action) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-1">
                                <select class="form-control" name="id">
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-{{ $action == 'delete' ? 'danger' : 'warning' }} col-md-3 text-capitalize">{{ $action }} User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
