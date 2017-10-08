@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-capitalize">{{ $action }} Element</div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('admin/element/save') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $element->id or '' }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-7 col-md-offset-1">
                                <input class="form-control text-capitalize" type="text" name="name" value="{{ $element->name or '' }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button class="btn btn-{{ $action == 'update' ? 'warning' : 'primary' }} col-md-3 text-capitalize">{{ $action }} Element</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
