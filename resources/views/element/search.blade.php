@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Element</div>
                <div class="panel-body">
                   <form method="GET" action="{{ url('admin/element/edit') }}">
                        <div class="form-group{{ $errors->has('element') ? ' has-error' : '' }}">
                            <div class="col-md-7 col-md-offset-1">
                                <select class="form-control text-capitalize" name="element">
                                    @foreach($elements as $element)
                                    <option value="{{ $element->id }}">{{ $element->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('element'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('element') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button class="btn btn-primary col-md-3">Edit Element</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
