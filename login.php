<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta data for iOS (was not working over HTTPS when testing but is fine over HTTP) -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png"/>

    <!-- Importing CSS -->
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/site_wide.css">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Find your Wi-Fi - Login</title>
</head>

<body>
    <!-- Importing header -->
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <!-- Map container -->
        <div id="map-container">
            <div id="map"></div>
            <!-- A simple transparent overlay spanning 100vw and 100vh -->
            <div id="map-overlay"></div>
            <!-- A container use to contain small visuals so that the page doesn't feel empty -->
            <div class="multi-pulse-container"></div>
        </div>

        <!-- Importing sign-in form -->
        <?php require(dirname(__FILE__)."/php/sign_in_form.php"); ?>    
    </main>
    <!-- Importing footer -->
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>
    <!-- Importing scripts -->
    <script src="/js/site_wide.js"></script>
    <script src="/js/auth.js"></script>
    <!-- Importing Google's Map API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmbU9tZG4JwV1yxn5pPQzGPmMOmW1BvyQ&callback=CreateMap"></script>    
</body>

</html>