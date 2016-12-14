@extends('frontend.layouts.app')

@section('content')
    {{ Form::open(['route' => ['frontend.application.apply',  $unit->availability->id], 'class' => 'form-horizontal']) }}
    <div class="row unit-listing">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="pull-left">Rental Application: {{ $unit->location->address }} - {{ $unit->name }}</h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                    <p class="h2">Application Information</p>
                    
                    <div class="form-group">
                        <label class="col-xs-1 control-label">Name</label>
                        <div class="col-xs-5">
                            <input class="form-control" name="name" value="{{ $user->name }}" {{ $user->name ? 'readonly="readonly"' : '' }}/>
                        </div>
                        <label class="col-xs-2 control-label">Password</label>
                        <div class="col-xs-4">
                            {{ Form::password('password', ['class' => 'form-control', ]) }}
                        </div>
                        <label class="col-xs-1 control-label">Email</label>
                        <div class="col-xs-5">
                            <input class="form-control" name="email" value="{{ $user->email }}" {{ $user->name ? 'readonly="readonly"' : '' }}/>
                        </div>
                        <label class="col-xs-2 control-label">Confirm Password</label>
                        <div class="col-xs-4">
                            {{ Form::password('password_confirmation', ['class' => 'form-control', ]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
                {{ Form::submit('Submit Application!', ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
    </div><!--row-->
    {{ Form::close() }}
@endsection