<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Bringing in connection to database

    // Prepare, bind, execute query
    $stmt = $pdo->prepare("SELECT DISTINCT Suburb FROM items ORDER BY Suburb ASC;");
    $stmt->execute();
    $suburb = $stmt->fetchAll();

    // Echo so XMLHttpRequest() requests can also get the data
    echo json_encode($suburb);
?>