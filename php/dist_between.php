<?php
    /* 
     *  Code to calculate distance was refactored to work for the context of the website.
     *  Original: http://www.movable-type.co.uk/scripts/latlong.html
     */


    // Function to calculate distance between two lat, lng coordinates
    function DistBetween($lat1, $lon1, $lat2, $lon2) {
        $Radius = 6371 * pow(10,3);
        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);
        $deltaLatRad = deg2rad(($lat1 - $lat2));
        $deltaLonRad = deg2rad(($lon1 - $lon2));

        $a = sin($deltaLatRad / 2) * sin($deltaLatRad / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($deltaLonRad / 2) * sin($deltaLonRad / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $d = $Radius * $c;

        return $d;
    };
?>