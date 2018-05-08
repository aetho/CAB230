<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/site_wide.css">
    <link rel="stylesheet" href="./css/register.css">
    <title>Find your Wi-Fi - Register</title>
</head>

<body>
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <div id="map-container">
            <div id="map"></div>
            <div id="map-overlay"></div>
            <div class="multi-pulse-container"></div>
        </div>
        <?php require(dirname(__FILE__)."/php/registration_form.php"); ?>    
    </main>
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>    
    <script src="./js/site_wide.js"></script>
    <script src="./js/register.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmbU9tZG4JwV1yxn5pPQzGPmMOmW1BvyQ&callback=CreateMap"></script>    
</body>

</html>