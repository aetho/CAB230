<?php
    // Connect to Database
    $pdo = new PDO('mysql:host=localhost;dbname=hotspots', 'min', 'abc123');
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>