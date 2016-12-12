if (typeof lat === 'undefined') {
    var lat = 44.229811;
}

if (typeof lng === 'undefined') {
    var lng = -76.4808145;
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: parseFloat(lat), lng: parseFloat(lng)},
        zoom: 16
    });

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
        console.log("moved");
//        loadMarkers(map.getBounds());
    });
}