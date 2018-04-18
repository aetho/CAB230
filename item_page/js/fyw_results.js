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

    AddSampleResults(map);
}

function AddSampleResults(map) {
    var names = [
        '7th Brigade Park, Chermside',
        'Annerley Library Wifi',
        'Ashgrove Library Wifi',
        'Banyo Library Wifi',
        'Booker Place Park',
        'Bracken Ridge Library Wifi',
        'Brisbane Botanic Gardens',
        'Brisbane Square Library Wifi',
        'Bulimba Library Wifi',
        'Calamvale District Park',
        'Carina Library Wifi',
        'Carindale Library Wifi',
        'Carindale Recreation Reserve',
        'Chermside Library Wifi',
        'City Botanic Gardens Wifi',
        'Coopers Plains Library Wifi',
        'Corinda Library Wifi',
        'D.M. Henderson Park',
        'Einbunpin Lagoon',
        'Everton Park Library Wifi',
        'Fairfield Library Wifi',
        'Forest Lake Parklands',
        'Garden City Library Wifi',
        'Glindemann Park',
        'Grange Library Wifi',
        'Gregory Park',
        'Guyatt Park',
        'Hamilton Library Wifi',
        'Hidden World Park',
        'Holland Park Library Wifi',
        'Inala Library Wifi',
        'Indooroopilly Library Wifi',
        'Kalinga Park',
        'Kenmore Library Wifi',
        'King Edward Park (Jacob\'s Ladder)',
        'King George Square',
        'Mitchelton Library Wifi',
        'Mt Coot-tha Botanic Gardens Library Wifi',
        'Mt Gravatt Library Wifi',
        'Mt Ommaney Library Wifi',
        'New Farm Library Wifi',
        'New Farm Park Wifi',
        'Nundah Library Wifi',
        'Oriel Park',
        'Orleigh Park',
        'Post Office Square',
        'Rocks Riverside Park',
        'Sandgate Library Wifi',
        'Stones Corner Library Wifi',
        'Sunnybank Hills Library Wifi',
        'Teralba Park',
        'Toowong Library Wifi',
        'West End Library Wifi',
        'Wynnum Library Wifi',
        'Zillmere Library Wifi'
    ]
    var address = [
        'Delaware St',
        '450 Ipswich Road',
        '87 Amarina Avenue',
        '284 St. Vincents Road',
        'Birkin Rd & Sugarwood St',
        'Corner Bracken and Barrett Street',
        'Mt Coot-tha Rd',
        'Brisbane Square, 266 George Street',
        'Corner Riding Road & Oxford Street',
        'Formby & Ormskirk Sts',
        'Corner Mayfield Road & Nyrang Street',
        'The Home and Leisure Centre, Corner Carindale Street  & Banchory Court, Westfield Carindale Shopping Centre',
        'Cadogan and Bedivere Sts',
        '375 Hamilton  Road',
        'Alice Street',
        '107 Orange Grove Road',
        '641 Oxley Road',
        'Granadilla St',
        'Brighton Rd',
        '561 South Pine Road',
        'Fairfield Gardens Shopping Centre, 180 Fairfield Road',
        'Forest Lake Bld',
        'Garden City Shopping Centre, Corner Logan and Kessels Road',
        'Logan Rd',
        '79 Evelyn Street',
        'Baroona Rd',
        'Sir Fred Schonell Dve',
        'Corner Racecourt Road and Rossiter Parade',
        'Roghan Rd',
        '81 Seville Road',
        'Inala Shopping centre, Corsair Ave',
        'Indrooroopilly Shopping centre, Level 4, 322 Moggill Road',
        'Kalinga St',
        'Kenmore Village Shopping Centre, Brookfield Road',
        'Turbot St and Wickham Tce',
        'Ann & Adelaide Sts',
        '37 Helipolis Parada',
        'Administration Building, Brisbane Botanic Gardens (Mt Coot-tha), Mt Coot-tha Road',
        '8 Creek Road',
        'Mt Ommaney Shopping Centre, 171 Dandenong Road',
        '135 Sydney Street',
        'Brunswick Street',
        '1 Bage Street',
        'Cnr of Alexandra & Lancaster Rds',
        'Hill End Tce',
        'Queen & Adelaide Sts',
        'Counihan Rd',
        'Seymour Street',
        '280 Logan Road',
        'Sunnybank Hills Shopping Centre, Corner Compton and Calam Roads',
        'Pullen & Osborne Rds',
        'Toowon Village Shopping Centre, Sherwood Road',
        '178 - 180 Boundary Street',
        'Wynnum Civic Centre, 66 Bay Terrace',
        'Corner Jennings Street and Zillmere Road'
    ]
    var suburb = [
        'Chermside',
        'Annerley',
        'Ashgrove',
        'Banyo',
        'Bellbowrie',
        'Bracken Ridge',
        'Toowong',
        'Brisbane',
        'Bulimba',
        'Calamvale',
        'Carina',
        'Carindale',
        'Carindale',
        'Chermside ',
        'Brisbane',
        'Coopers Plains ',
        'Corinda ',
        'MacGregor',
        'Sandgate',
        'Everton park ',
        'Fairfield ',
        'Forest Lake',
        'Upper Mount Gravatt ',
        'Holland Park West',
        'Grange ',
        'Paddington',
        'St Lucia',
        'Hamilton ',
        'Fitzgibbon',
        'Holland Park ',
        'Inala ',
        'Indooroopilly ',
        'Clayfield',
        'Kenmore ',
        'Brisbane',
        'Brisbane',
        'Mitchelton ',
        'Toowong ',
        'Mt Gravatt ',
        'Mt Ommaney ',
        'New Farm ',
        'New Farm',
        'Nundah ',
        'Ascot',
        'West End',
        'Brisbane',
        'Seventeen Mile Rocks',
        'Sandgate ',
        'Stones Corner ',
        'Sunnybank Hills ',
        'Everton Park',
        'Toowong ',
        'West End ',
        'Wynnum ',
        'Zillmere '
    ]
    var lat = [-27.37893, -27.50942285, -27.44394629, -27.37396641, -27.56353, -27.31797261, -27.47724, -27.47091173, -27.45203086, -27.62152, -27.49169314, -27.50475928, -27.497, -27.3856032, -27.47561, -27.56510509, -27.53880237, -27.57745, -27.31947, -27.4053336, -27.50909038, -27.6202, -27.56244221, -27.52552, -27.42531193, -27.467, -27.49297, -27.43790137, -27.33971701, -27.52292286, -27.59828574, -27.49764287, -27.40666, -27.50592852, -27.46589, -27.46843, -27.41704165, -27.47529908, -27.53855482, -27.54824198, -27.46736574, -27.47046, -27.40125908, -27.42928, -27.48995, -27.46735, -27.54153, -27.32060523, -27.49803575, -27.6109253, -27.40286, -27.48505116, -27.48245078, -27.44244894, -27.36014232]
    var lng = [
        153.04461,
        153.0333218,
        152.9870981,
        153.0783234,
        152.89372,
        153.0378735,
        152.97599,
        153.0224598,
        153.0628242,
        153.03665,
        153.0912127,
        153.1003965,
        153.11105,
        153.0349028,
        153.03005,
        153.0403183,
        152.9809091,
        153.07603,
        153.06822,
        152.9904205,
        153.0259709,
        152.96625,
        153.0809183,
        153.06923,
        153.0174728,
        152.99981,
        153.00187,
        153.0642227,
        153.034981,
        153.0722921,
        152.9735217,
        152.9736471,
        153.05217,
        152.9386437,
        153.02406,
        153.02422,
        152.9783402,
        152.9760412,
        153.0802628,
        152.9378099,
        153.0495841,
        153.05223,
        153.0583751,
        153.05768,
        153.00326,
        153.02735,
        152.95913,
        153.0704927,
        153.043655,
        153.0550706,
        152.98059,
        152.9925091,
        153.0120763,
        153.1731968,
        153.0407898
    ]

    for (var i = 0; i < names.length; i++) {
        var listItem = document.createElement('a');
        listItem.classList.add('list-item-multiline');

        var listItemName = document.createElement('div');
        listItemName.classList.add('list-item-row');
        listItemName.classList.add('list-item-title');
        if (names[i].length > 30) {
            listItemName.innerHTML = names[i].slice(0, 30) + '...'
        } else {
            listItemName.innerHTML = names[i];
        }

        var listItemAddress = document.createElement('div');
        listItemAddress.classList.add('list-item-row');
        listItemAddress.classList.add('list-item-subheading');
        if (address[i].length > 30) {
            listItemAddress.innerHTML = 'Address: ' + address[i].slice(0, 30) + '...'
        } else {
            listItemAddress.innerHTML = 'Address: ' + address[i]
        }

        var listItemSuburb = document.createElement('div');
        listItemSuburb.classList.add('list-item-row');
        listItemSuburb.classList.add('list-item-subheading');
        listItemSuburb.innerHTML = 'Suburb: ' + suburb[i];

        listItem.appendChild(listItemName);
        listItem.appendChild(listItemAddress);
        listItem.appendChild(listItemSuburb);

        var resultList = document.getElementById('result-list');
        if (resultList) resultList.appendChild(listItem);

        (function (index) {
            var marker = new google.maps.Marker({
                position: {
                    lat: lat[i],
                    lng: lng[i]
                },
                map: map,
                title: names[i]
            });

            marker.addListener('click', function (e) {
                map.setZoom(14);
                map.panTo(marker.getPosition());
            })
        })(i);
    }
}

// document.addEventListener('DOMContentLoaded', function (e) {
//     AddSampleResults();
// })