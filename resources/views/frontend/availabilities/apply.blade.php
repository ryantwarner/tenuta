@extends('frontend.layouts.app')

@section('content')
    <form class="form-horizontal">
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
                            <input class="form-control" name="name" />
                        </div>
                        <label class="col-xs-1 control-label">Email</label>
                        <div class="col-xs-5">
                            <input class="form-control" name="email" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
                <a href="{{ route('frontend.availabilities.apply', ['id' => $unit->availability->id]) }}" class="btn btn-primary pull-right">Apply Now!</a>
            </div>
        </div>
    </div><!--row-->
    </form>
@endsection

@section('after-scripts-end')
    <!--{{ Html::script('js/gmap.js', ['async', 'defer']) }}-->
    <!--{{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCL_Eej0c8tpexdC27jXvXRyHPFC1CIIaw&callback=initUnitMap', ['async', 'defer']) }}-->
@endsection