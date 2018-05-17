<?php
    // Used for testing the search by rating feature
    require('./connect_to_db.php');
    for ($i = 1; $i <= 30; $i++){
        for ($j = 0; $j < 10; $j++){
            $itemID = $i;
            $date = date("Y-m-d");
            $userID = 11; // $_SESSION['userID'];

            $content = "Lorem ipsum dolor sit amet.consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."; // $_POST['reviewText']
            $rating = rand(1,5); // $_POST[rating]

            $stmt = $pdo->prepare("INSERT INTO reviews (itemID, date, userID, content, rating) VALUES (:itemID, :date, :userID, :content, :rating);");
            $stmt->bindParam(':itemID', $itemID);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':rating', $rating);

            $stmt->execute();
        }
    }
?>