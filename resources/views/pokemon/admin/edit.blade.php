@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-capitalize">{{ $action }} Pokemon</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/pokemon/'.$action) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ $action == 'update' ? method_field('PUT') : '' }}
                        <input type="hidden" name="id" value="{{ $pokemon->id }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Pokemon Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $pokemon->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('element') ? ' has-error' : '' }}">
                            <label for="element" class="col-md-4 control-label">Element</label>

                            <div class="col-md-6">
                                <select id="element" class="form-control text-capitalize" name="element">
                                    @foreach($elements as $element)
                                    <option value="{{ $element->id }}" {{ $pokemon->element_id == $element->id ? 'selected' : '' }}>{{ $element->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('element'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('element') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(isset($pokemon->image))
                        <div class="text-center">
                            <img src="{{ asset('img/pokemon/'.$pokemon->image) }}">
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ $pokemon->image }}">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <label for="male" class="col-md-2">Male</label>
                                <input id="male" type="radio" class="col-md-2" name="gender" value="male" {{ $pokemon->gender == 'male' ? 'checked' : '' }}>
                                <label for="female" class="col-md-2">Female</label>
                                <input id="female" type="radio" class="col-md-2" name="gender" value="female" {{ $pokemon->gender == 'female' ? 'checked' : '' }}>
                                <br>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{ $pokemon->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="text" id="price" class="form-control" name="price" value="{{ $pokemon->price }}">

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-{{ $action == 'update' ? 'warning' : 'primary' }} text-capitalize">
                                    <i class="fa fa-btn fa-user"></i> {{ $action }} Pokemon
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
