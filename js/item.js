function CreateMap() {
    // Create map and place it in #map
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {
            lat: 0,
            lng: 0
        },
        disableDefaultUI: true
    });

    // Center map
    CenterMap(map);
}

function CenterMap(map) {
    // Create XMLHttpRequest Object
    var xmlhttp = new XMLHttpRequest();
    // Attach handler for 'load' event
    xmlhttp.onload = function () {
        // Parse response to JSON
        var rows = JSON.parse(this.responseText);
        // Extract relevant info for marker
        var latLng = {
            lat: Number(rows[0]['Latitude']),
            lng: Number(rows[0]['Longitude'])
        }
        // Create new Marker object and initialise it with extract info
        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            title: name
        });
        // Center map on marker
        map.setCenter(latLng);
    };

    // Get query parameters from window url
    var queryStr = window.location.href.split('?')[1];
    // Initalise XMLHttp request with the url and method
    xmlhttp.open("GET", "/php/get_item.php?" + queryStr, true);
    // Send request
    xmlhttp.send();
}