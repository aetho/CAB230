<?php
    // Using output buffers to suppress echo calls
    ob_start();
    require(dirname(__FILE__).'/get_results.php');
    ob_end_clean();

    // Get result count
    $resultCount = count($result);

    // Use result count to inform the user accordingly
    echo"<div class=\"list-item-multiline\">".
        "<div class=\"list-item-row list-item-title\">Found $resultCount hotspot(s)</div>".
        "</div>";

    // if there are results then add then to the list
    if($resultCount > 0){   
        // Loop through each result
        foreach($result as $row){
            // Extract required information
            $ID = $row['ID'];
            $name = $row['Wifi Hotspot Name'];
            $address = $row['Address'];
            $suburb = $row['Suburb'];

            // Truncating $name
            if (strlen($name) > 30) {
                $name = substr($name, 0, 30) . '...';
            }

            // Truncating $address
            if (strlen($address) > 30) {
                $address = substr($address, 0, 30) . '...';
            }

            // Add item to list using an echo statement
            echo"<a class=\"list-item-multiline\" href=\"/item.php?ID=$ID\">".
                "<div class=\"list-item-row list-item-title\">$name</div>".
                "<div class=\"list-item-row list-item-subheading\">Address: $address</div>".
                "<div class=\"list-item-row list-item-subheading\">Suburb: $suburb</div>".
                "</a>";
        }
    }

?>

