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

function removeAllMarkers() {
    for (var key in markers) {
        markers[key].setMap(null);
        delete markers[key];
        delete nav[key];
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

function loadMarkers(bounds, page) {
    if (typeof(page) === "undefined") {
        page = 1;
    }
    $.getJSON('/api/availabilities?page=' + page, bounds.toJSON(), function(response) {
        var availabilities = response.data;
        for (var i = 0; i < availabilities.length; i++){
            var infowindow = new google.maps.InfoWindow();

            if (typeof markers[availabilities[i].id] === 'undefined') {
                markers[availabilities[i].id] = new google.maps.Marker({
                    position: new google.maps.LatLng(availabilities[i].location.lat, availabilities[i].location.lng),
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
    }).done(function(response) {
        $(".total-units").html(response.total);
        $(".pagination-current").html(response.current_page);
        $(".pagination-total").html(response.last_page);
        $(".pagination-next").data("page", response.current_page + 1);
        $(".pagination-prev").data("page", response.current_page - 1);
        
        removeDeadMarkers(bounds);
        if (settings.has_nav === true) {
            updateNav();
        }
    });
}

$(".pagination-next, .pagination-prev").on("click", function(e) {
    e.preventDefault();

    localStorage["saved_page"] = $(this).data("page");

    if (
            ($(this).hasClass("pagination-prev") && $(this).data("page") >= 1) || 
            ($(this).hasClass("pagination-next") && $(this).data("page") <= $(".pagination-total").html())
        ) {
        removeAllMarkers();
        loadMarkers(map.getBounds(), $(this).data("page"));
    }
});