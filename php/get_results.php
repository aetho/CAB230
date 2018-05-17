<?php
    require(dirname(__FILE__).'/dist_between.php'); // Bringing in DistBetween function
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Bringing in connection to database

    // Get all items for the default result
    $stmt = $pdo->prepare("SELECT * FROM items;");
    $stmt->execute();
    $result = $stmt->fetchAll();

    // if searchMode is set and not empty then execute the appropriate query 
    if(isset($_GET['searchMode']) || !empty($_GET['SearchMode'])){        
        // Making sure searchMode is set. (In case client validation failed).
        $searchMode = $_GET['searchMode'];
        switch ($searchMode) {
            case 'Nearby':
                // Prepare, bind, execute query
                $stmt = $pdo->prepare("SELECT * FROM items");
                $stmt->bindParam(':fieldValue', $value);
                $stmt->execute();
                $result = $stmt->fetchAll();

                $maxDist = 2000; // meters
                if(isset($_GET['userLat']) && isset($_GET['userLon']) ){
                    $lat1 = $_GET['userLat'];
                    $lon1 = $_GET['userLon'];

                    // Go through all results and check their distance from user position
                    $numResults = count($result);
                    for($i = 0; $i < $numResults; $i++){
                        $lat2 = $result[$i]['Latitude'];
                        $lon2 = $result[$i]['Longitude'];
                        $dist = DistBetween($lat1, $lon1, $lat2, $lon2);
                        if($dist > $maxDist){
                            // Delete results that are further than $maxDist
                            unset($result[$i]);
                        }
                    }
                    // Re-index results because unset() does not re-index
                    $result = array_values($result);
                }
            break;
            case 'Name':
                // Making sure searchName is set. (In case client validation failed).
                if(isset($_GET['searchName'])){
                    $value = $_GET['searchName'];
                    // bindParam passes apostrophe (') so have to add the % before binding
                    $value = "%".$value."%";

                    // Prepare, bind, execute query
                    $stmt = $pdo->prepare("SELECT * FROM items WHERE `Wifi Hotspot Name` LIKE :fieldValue");
                    $stmt->bindParam(':fieldValue', $value);
                    $stmt->execute();

                    // Get results as an array
                    $result = $stmt->fetchAll();
                }
                break;
            case 'Suburb':
                // Making sure searchSuburb is set. (In case client validation failed).            
                if(isset($_GET['searchSuburb'])){
                    $value = $_GET['searchSuburb'];

                    // Prepare, bind, execute query
                    $stmt = $pdo->prepare("SELECT * FROM items WHERE `Suburb` = :fieldValue");
                    $stmt->bindParam(':fieldValue', $value);
                    $stmt->execute();

                    // Get results as an array
                    $result = $stmt->fetchAll();
                }
                break;
            case 'Rating':
                if(isset($_GET['searchRating'])){
                    $value = $_GET['searchRating'];
                    // Get items with rating greater or equal to specified rating (sorted in descending order)
                    $stmt = $pdo->prepare(
                        "SELECT * FROM (
                            SELECT avg(rating) as avgRating, itemID
                            FROM reviews
                            GROUP BY itemID
                        ) as ratings, items WHERE avgRating >= :fieldValue AND ratings.itemID = items.ID;"
                    );
                    $stmt->bindParam(':fieldValue', $value);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                }
                break;
            default:
                $stmt = $pdo->prepare("SELECT * FROM items;");
                $stmt->execute();
                $result = $stmt->fetchAll();
                break;
        }
    }

    // Echo so XMLHttpRequest() requests can also get the data
    echo json_encode($result);
?>