@extends('frontend.layouts.app')

@section('content')
    <div class="row unit-listing">
        <div class="panel">
            <div class="panel-heading clearfix">
                <h3 class="pull-left">{{ $unit->location->address }} - {{ $unit->name }}</h3>
                <p class="h3 pull-right">Listed on: 2016-12-01</p>
            </div>
            <div class="panel-body">
                <div class="col-xs-8">
                    <p class="h2">Description</p>
                    <p>{{ $unit->description }}</p>
                    <p class="h2">Features</p>
                    <div class="col-xs-12 col-sm-6">
                        <ul>
                            <li><strong>Lease Type:</strong> {{ $unit->lease_type }}</li>
                            <li><strong>Lease Length:</strong> {{ $unit->lease_length }}</li>
                            <li><strong>Heat Included:</strong> {{ $unit->heat_included ? "Yes" : "No"}}</li>
                            <li><strong>Elect. Included:</strong> {{ $unit->electricity_included ? "Yes" : "No"}}</li>
                            <li><strong>Water Included:</strong> {{ $unit->water_included ? "Yes" : "No"}}</li>
                            <li><strong>Internet Included:</strong> {{ $unit->internet_included ? "Yes" : "No"}}</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <ul>
                            <li><strong>Furnished:</strong> {{ $unit->furnished ? "Yes" : "No"}}</li>
                            <li><strong>Air Conditioned:</strong> {{ $unit->air_conditioned ? "Yes" : "No"}}</li>
                            <li><strong>Parking Available:</strong> {{ $unit->parking_available ? "Yes" : "No"}}</li>
                            <!--<li><strong>Parking Spaces:</strong> {{ $unit->heat_included ? "Yes" : "No"}}</li>-->
                            <li><strong>Laundry:</strong> {{ $unit->laundry_onsite ? "Yes" : "No"}}</li>
                            <li><strong>Accessibility Features:</strong> {{ $unit->avvessibility_features ? "Yes" : "No"}}</li>
                        </ul>
                    </div>
                    <div class="col-xs-12">
                        <p class="h3">Files</h3>
                        <ul>
                            @forelse ($files as $file)
                            <li><a href="#"><img src="{{ route('frontend.availabilities.image', ['id' => $unit->availability->id, 'filename' => $image]) }}" class="thumbnail" /></a></li>
                            @empty
                            <li>There are no files associated with this unit.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div id="map"></div>
                    <ul class="modal-gallery">
                        @forelse ($images as $image)
                        <li><a href="#"><img src="{{ route('frontend.availabilities.image', ['id' => $unit->availability->id, 'filename' => $image]) }}" class="thumbnail" /></a></li>
                        @empty
                        
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <a href="{{ url()->previous() }}" class="btn btn-default pull-left">Back</a>
                <a href="{{ route('frontend.availabilities.apply', ['id' => $unit->availability->id]) }}" class="btn btn-primary pull-right">Apply Now!</a>
            </div>
        </div>
    </div><!--row-->
@endsection

@section('after-scripts-end')
    {{ Html::script('js/gmap.js', ['async', 'defer']) }}
    {{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCL_Eej0c8tpexdC27jXvXRyHPFC1CIIaw&callback=initMap', ['async', 'defer']) }}
@endsection