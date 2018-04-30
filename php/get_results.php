<?php
    $pdo = new PDO('mysql:host=localhost;dbname=hotspots', 'min', 'abc123');

    $column;
    $value;
    $queryStr;

    if(!isset($_GET['searchMode']) || empty($_GET['searchMode'])){
        $queryStr = "SELECT * FROM items";
    }else{
        $searchMode = $_GET['searchMode'];
        switch($searchMode){
            case "Name":
                $column = 'Wifi Hotspot Name';
                if(isset($_GET['searchName'])){
                    $value = $_GET['searchName'];
                    $queryStr = "SELECT * FROM items WHERE `$column` LIKE '%$value%';";
                }else{
                    $queryStr = "SELECT * FROM items;";
                }
                break;
            case "Suburb":
                $column = 'Suburb';
                if(isset($_GET['searchSuburb'])){
                    $value = $_GET['searchSuburb'];
                    $queryStr = "SELECT * FROM items WHERE `$column`='$value';";
                }else{
                    $queryStr = "SELECT * FROM items;";
                }
                break;
            case "Rating":
                $column = 'Rating';
                if(isset($_GET['searchRating'])){
                    $value = $_GET['searchRating'];
                    $queryStr = "SELECT * FROM items WHERE `$column`>='$value';";
                }else{
                    $queryStr = "SELECT * FROM items;";
                }
                break;
            default:
                $queryStr = "SELECT * FROM items;";
        }
    }

    
    $result = $pdo->query($queryStr);
    
    // Send data as JSON so that javascript has a way of accessing/see the data
    echo json_encode($pdo->query($queryStr)->fetchAll());
?>