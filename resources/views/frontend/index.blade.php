@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="clearfix">
                        <h3 class="panel-title pull-left">Available Units: <span class="total-units"></span></h3>
                        <a href="#filters" class="pull-right" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="filters"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    </div>
                    <div id="filters" class="collapse">
                        <p class="h5">Filters</p>
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('heat', true) }} Heat included
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('electricity', true) }} Electricity included
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="list-nav" class="list-group">
                        <span class="fa fa-spinner"></span>
                    </div>
                </div>
                <div class="panel-footer clearfix text-center">
                    <a href="#" class="pagination-prev pull-left"><span class="glyphicon glyphicon-backward"></span></a>
                    Page 
                    <span class="pagination-current"></span>
                    of 
                    <span class="pagination-total"></span>
                    <a href="#" class="pagination-next pull-right"><span class="glyphicon glyphicon-forward"></span></a>
                </div>
            </div>
        </div>
        <div class="col-xs-8">
            <div id="map" data-lat="44.2354609" data-lng="-76.4982835"></div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts-end')
    {{ Html::script('js/gmap.js', ['async', 'defer']) }}
    {{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCL_Eej0c8tpexdC27jXvXRyHPFC1CIIaw&callback=initMap', ['async', 'defer']) }}
@endsection