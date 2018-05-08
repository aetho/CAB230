<?php
    // Using output buffers to suppress echo
    ob_start();
    require(dirname(__FILE__).'/get_results.php');
    ob_end_clean();

    $resultCount = count($result);
    echo"<div class=\"list-item-multiline\">".
        "<div class=\"list-item-row list-item-title\">Found $resultCount hotspot(s)</div>".
        "</div>";
    if($resultCount > 0){   
        foreach($result as $row){            
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

            echo"<a class=\"list-item-multiline\" href=\"./item.php?ID=$ID\">".
                "<div class=\"list-item-row list-item-title\">$name</div>".
                "<div class=\"list-item-row list-item-subheading\">Address: $address</div>".
                "<div class=\"list-item-row list-item-subheading\">Suburb: $suburb</div>".
                "</a>";
        }
    }

?>

