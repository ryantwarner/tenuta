var settings = {
    'zoom': localStorage.getItem("saved_zoom") !== null ? parseInt(localStorage.getItem("saved_zoom")) : 16,
    'center': {
        lat: parseFloat(
            localStorage.getItem("saved_lat") !== null ? localStorage.getItem("saved_lat") : $("#map").data("lat")
        ), 
        lng: parseFloat(
            localStorage.getItem("saved_lng") !== null ? localStorage.getItem("saved_lng") : $("#map").data("lng")
        )
    },
    'disableDefaultUI' : false,
    'disableDoubleClickZoom' : true,
    'mapTypeControl' : false,
    'streetViewControl' : false,
    'has_nav' : true
};

var markers = {};
var nav = {};
var map;

function initUnitMap() {
    settings.disableDefaultUI = true;
    settings.zoom = 20;
    settings.has_nav = false;
    initMap();
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), settings);

    var infoWindow = new google.maps.InfoWindow({map: map});
    infoWindow.close();

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        handleLocationError(false, infoWindow, map.getCenter());
    }

    google.maps.event.addListener(map, 'idle', function() {
        localStorage.setItem("saved_lat", map.getCenter().lat());
        localStorage.setItem("saved_lng", map.getCenter().lng());
        if (settings.has_nav === true) {
            localStorage.setItem("saved_zoom", map.getZoom());
        }
        loadMarkers(map.getBounds());
    });
}

function updateNav() {
    $("#list-nav").empty();
    for (var key in nav) {
        $("#list-nav").append(
            $(document.createElement("a")).attr({'class' : 'list-group-item', 'href' : '/unit/' + nav[key].id}).append(
                nav[key].name
            )
        );
    }
}

function removeDeadMarkers(bounds) {
    for (var key in markers) {
        if (!bounds.contains(markers[key].getPosition())) {
            markers[key].setMap(null);
            delete markers[key];
            delete nav[key];
        }
    }
}

function loadMarkers(bounds) {
    $.getJSON('/api/availabilities', bounds.toJSON(), function(availabilities) {
        for (var i = 0; i < availabilities.length; i++){
            var infowindow = new google.maps.InfoWindow();

            if (typeof markers[availabilities[i].id] === 'undefined') {
                markers[availabilities[i].id] = new google.maps.Marker({
                    position: new google.maps.LatLng(availabilities[i].lat, availabilities[i].lng),
                    map: map
                });

                google.maps.event.addListener(markers[availabilities[i].id], 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(
                            '<h1>' + availabilities[i].name + '</h1>'
                            + (availabilities[i].description != null ? "<p>" + availabilities[i].description + "</p>" : "")
                            + "<p><a class='btn btn-default' href='/unit/" + availabilities[i].id + "'>Vendor Profile</a></p>"
                        );
                        infowindow.open(map, marker);
                    };
                })(markers[availabilities[i].id], i));
                
                nav[availabilities[i].id] = availabilities[i];
            }
        }
    }).done(function() {
        removeDeadMarkers(bounds);
        if (settings.has_nav === true) {
            updateNav();
        }
    });
}