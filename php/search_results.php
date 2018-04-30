<?php
    // Using output buffers to suppress echo
    ob_start();
    include('./php/get_results.php');
    ob_end_clean();

    $resultCount = $result->rowCount();
    echo "<div class=\"list-item-multiline\">";
    echo "<div class=\"list-item-row list-item-title\">Found $resultCount hotspot(s)</div>";
    echo "</div>";
    if($resultCount > 0){
        foreach($result as $row){
            $ID = $row['ID'];
            $name = $row['Wifi Hotspot Name'];
            $address = $row['Address'];
            $suburb = $row['Suburb'];

            if (strlen($name) > 30) {
                $name = substr($name, 0, 30) . '...';
            }

            if (strlen($address) > 30) {
                $address = substr($address, 0, 30) . '...';
            }

            echo "<a class=\"list-item-multiline\" href=\"./item.php?ID=$ID\">";
            echo "<div class=\"list-item-row list-item-title\">$name</div>";
            echo "<div class=\"list-item-row list-item-subheading\">Address: $address</div>";
            echo "<div class=\"list-item-row list-item-subheading\">Suburb: $suburb</div>";
            echo "</a>";
        }
    }

?>

