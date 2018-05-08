document.addEventListener('DOMContentLoaded', function(e){
    var loader = document.getElementById('map-load');
    loader.style.display = 'block';
});

function InitMap(position, map) {
    var coords = position.coords;
    var latLng = {
        lat: coords.latitude,
        lng: coords.longitude
    }

    var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        title: 'Me'
    });

    map.setCenter(latLng);

    AddResultsMarkers(map);
    var loader = document.getElementById('map-load');
    loader.style.display = 'none';
}

function geoError(err){
    // Log error to console if error occurred 
    console.log(err);
}

var geoOptions = {
    // Allow geolocation api to use location from the last 3 minutes
    maximumAge: 3 * 60 * 1000
}

function CreateMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {
            lat: 0,
            lng: 0
        },
        disableDefaultUI: true
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            InitMap(position, map);
        }, geoError, geoOptions);
    } 
}


function AddResultsMarkers(map) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        var rows = JSON.parse(this.responseText);
        // console.log(rows);
        for (var i = 0; i < rows.length; i++) {
            var name, lat, lng;
            name =  rows[i]['Wifi Hotspot Name'];
            lat =  rows[i]['Latitude'];
            lng =  rows[i]['Longitude'];
            
            (function (index) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: Number(lat),
                        lng: Number(lng)
                    },
                    map: map,
                    title: name
                });
                
                marker.addListener('click', function (e) {
                    map.setZoom(14);
                    map.panTo(marker.getPosition());
                })
            })(i);
        }
    };

    var queryStr =  window.location.href.split('?')[1];
    xmlhttp.open("GET", "./../php/get_results.php?"+ queryStr, true);
    xmlhttp.send();    
}