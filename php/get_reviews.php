<?php
    require_once(dirname(__FILE__)."/connect_to_db.php");
    if(isset($_GET['ID'])){
        // Get item details
        $reviewStmt = $pdo->prepare("
            SELECT itemID, fName, lName, date, content, rating FROM members, (
                SELECT itemID, userID, date, content, rating
                FROM items, reviews
                WHERE items.ID = :id AND items.ID = reviews.itemID
                ORDER BY reviews.date DESC) as reviews
            WHERE members.id = reviews.userID;
        ");
        // Bind parameters
        $reviewStmt->bindParam(':id', $_GET['ID']);
        // Execute statement
        $reviewStmt->execute();
        // Get the results as an array
        $reviewResult = $reviewStmt->fetchAll();
    }else{
        // Echo error and exit
        echo "Could not find item reviews";
        exit;
    }
?>