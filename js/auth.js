document.addEventListener('DOMContentLoaded', function(e){
    // Get a reference to the multi-pulse-container
    var pulseContainer = document.getElementsByClassName('multi-pulse-container');
    // if a multipulse container exist then create pulse and add them to container
    if(pulseContainer.length > 0){
        // Set number of pulse icons
        var nPulse = 12;
        // Array used to store pulse positions, ids and delays
        var pulseArray = [];

        // Setting pulse positions, ids, and delays randomly
        for(var i = 0; i < nPulse; i++){
            var pulse;
            if(i < nPulse/4){
                pulse = {
                    id:'pulse-'+ (i+1),
                    delay: Math.random()*5+"s",
                    top: (10 + Math.round(Math.random()*30)) +"%",
                    left: (10 + Math.round(Math.random()*30))+"%"
                }
            }else if(i < 2 * (nPulse/4)){
                pulse = {
                    id:'pulse-'+ (i+1),
                    delay: Math.random()*5+"s",
                    top: (10 + Math.round(Math.random()*30)) +"%",
                    left: (60 + Math.round(Math.random()*20))+"%"
                }
            }else if(i < 3 * (nPulse/4)){
                pulse = {
                    id:'pulse-'+ (i+1),
                    delay: Math.random()*5+"s",
                    top: (60 + Math.round(Math.random()*30)) +"%",
                    left: (10 + Math.round(Math.random()*30))+"%"
                }
            }else{
                pulse = {
                    id:'pulse-'+ (i+1),
                    delay: Math.random()*5+"s",
                    top: (60 + Math.round(Math.random()*30)) +"%",
                    left: (60 + Math.round(Math.random()*30))+"%"
                }
            }
            pulseArray.push(pulse);
        }

        // Add pulses to the container
        for (var i = 0; i < pulseArray.length; i++){
            var pulse = document.createElement('div');
            pulse.classList.add('pulse');
            pulse.id = pulseArray[i].id;
            pulse.style.animationDelay = pulseArray[i].delay;
            pulse.style.top = pulseArray[i].top;
            pulse.style.left = pulseArray[i].left;


            var icon = document.createElement('i');
            icon.classList.add('material-icons');
            icon.innerHTML = 'wifi';

            pulse.appendChild(icon);
            pulseContainer[0].appendChild(pulse);
        }
    }
});

// Create a map centered on the user
// This will be used as a background for the login/register pages
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
            var coords = position.coords;
            var latLng = {
                lat: coords.latitude,
                lng: coords.longitude
            }
            // Center map on user location
            map.setCenter(latLng);
        }, function(err){console.log(err)}, {maximumAge: 3 * 60 * 1000});
    } 
}