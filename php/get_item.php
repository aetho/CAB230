<?php
    require_once(dirname(__FILE__)."/connect_to_db.php");
    if(isset($_GET['ID'])){
        // Get item details
        $itemStmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
        $itemStmt->bindParam(':id', $_GET['ID']);
        $itemStmt->execute();
        $itemResult = $itemStmt->fetchAll();

        // Validating retrieved results
        if(count($itemResult) < 1){
            // Echo error and exit
            echo "Could not find item with id {$_GET['ID']}";
            exit;
        }else{
            // Echo so XMLHttpRequest() requests can also get the data
            echo json_encode($itemResult);
        }
        
        // Get item avg rating
        $ratingStmt = $pdo->prepare("
            SELECT * FROM (
                SELECT avg(rating) as avgRating, itemID
                FROM reviews
                GROUP BY itemID
            ) as ratings
            WHERE ratings.itemID = :id;
        ");
        // Bind parameters
        $ratingStmt->bindParam(':id', $_GET['ID']);
        // Execute statement
        $ratingStmt->execute();
        // Get the results as an array
        $ratingResult = $ratingStmt->fetchAll();

        // Validating retrieved results
        if(count($ratingResult) < 1){
            // Set rating to default
            $ratingResult[0]['avgRating'] = "NA";
        }
    }else{
        // Echo error and exit
        echo "Could not find item";
        exit;
    }
?>