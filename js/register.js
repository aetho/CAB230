document.addEventListener('DOMContentLoaded', function(e){
    var pulseContainer = document.getElementsByClassName('multi-pulse-container');
    if(pulseContainer.length > 0){
        var nPulse = 24;
        var pulseArray = [];

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
            var coords = position.coords;
            var latLng = {
                lat: coords.latitude,
                lng: coords.longitude
            }
            map.setCenter(latLng);

        }, function(err){console.log(err)}, {maximumAge: 3 * 60 * 1000});
    } 
}