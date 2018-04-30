function CreateMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {
            lat: 0,
            lng: 0
        },
        disableDefaultUI: true
    });

    CenterMap(map);
}

function CenterMap(map) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var coords = position.coords;
            var latLng = {
                lat: coords.latitude,
                lng: coords.longitude
            }
            map.setCenter(latLng);

            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });

            map.setZoom(12);
        });
    }

    AddResultsMarkers(map);
}

function AddResultsMarkers(map) {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        var rows = JSON.parse(this.responseText);
        
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