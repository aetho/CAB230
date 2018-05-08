<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/site_wide.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Find your Wi-Fi - Results</title>
</head>

<body>
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <div id="map-container">
            <div id="map"></div>
            <div class="load-container" id="map-load">
                <div class="load-spinner"></div>
            </div>
        </div>
        <div class="list" id="result-list">
            <?php require(dirname(__FILE__)."/php/search_results.php"); ?>
        </div>
    </main>
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>
    <script src="./js/site_wide.js"></script>
    <script src="./js/index.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmbU9tZG4JwV1yxn5pPQzGPmMOmW1BvyQ&callback=CreateMap"></script>
</body>

</html>