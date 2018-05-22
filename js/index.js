document.addEventListener('DOMContentLoaded', function(e){
    // Show loading placeholder when DOMContentLoaded
    var loader = document.getElementById('map-load');
    loader.style.display = 'block';
});

function InitMap(position, map) {
    // Get coordinates from position which is a geolocation position object
    var coords = position.coords;
    var latLng = {
        lat: coords.latitude,
        lng: coords.longitude
    }

    // Center map on current position
    map.setCenter(latLng);

    // Add markers onto map after centering
    AddResultsMarkers(map);

    // Hide loading placeholder
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
    // Create map and place it in #map
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {
            lat: 0,
            lng: 0
        },
        disableDefaultUI: true
    });

    // Check geolocation support
    if (navigator.geolocation) {
        // Get user current position (if user gives permission)
        navigator.geolocation.getCurrentPosition(function(position){
            // Initialise the map
            InitMap(position, map);
        }, geoError, geoOptions);
    } 
}

// Function that adds markers, for each result, to the map
function AddResultsMarkers(map) {
    // Create XMLHttpRequest Object
    var xmlhttp = new XMLHttpRequest();
    // Attach handler for 'load' event
    xmlhttp.onload = function () {
        // Parse response to JSON
        var rows = JSON.parse(this.responseText);

        // Loop through response items and add a marker for each
        for (var i = 0; i < rows.length; i++) {
            var name, lat, lng;

            // Extract relevant info for marker
            name =  rows[i]['Wifi Hotspot Name'];
            lat =  rows[i]['Latitude'];
            lng =  rows[i]['Longitude'];
            url = '/item.php?ID='+rows[i]['ID'];

            // Create new Marker object and initialise it with extract info
            var marker = new google.maps.Marker({
                position: {
                    lat: Number(lat),
                    lng: Number(lng)
                },
                map: map,
                title: name,
                url: url
            });
            
            // Attach handler to marker
            marker.addListener('click', function () {
                // Navigate to item url on click
                window.location.href = this.url;
            });
        }
    };

    // Get query parameters from window url
    var queryStr =  window.location.href.split('?')[1];
    
    // Initalise XMLHttp request with the url and method
    xmlhttp.open("GET", "/php/get_results.php?"+ queryStr, true);

    // Send request
    xmlhttp.send();    
}