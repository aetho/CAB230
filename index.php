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
    <link rel="stylesheet" href="/css/index.css">
    <title>FYW - Find your wifi</title>
</head>

<body>
    <!-- Inporting header -->
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <!-- Map container -->
        <div id="map-container">
            <!-- Map element that will be filled by Google's map API -->
            <div id="map"></div>
            <!-- 
                Loading element that will be shown while waiting for
                the HTML Geolocation API.
            -->
            <div class="load-container" id="map-load">
                <div class="load-spinner"></div>
            </div>
        </div>
        <!-- Results container -->
        <div class="list" id="result-list">
            <!-- Importing search results -->
            <?php require(dirname(__FILE__)."/php/search_results.php"); ?>
        </div>
    </main>

    <!-- Importing footer -->
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>
    <!-- Importing Scripts -->
    <script src="/js/site_wide.js"></script>
    <script src="/js/index.js"></script>
    <!-- Importing Google's Map API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmbU9tZG4JwV1yxn5pPQzGPmMOmW1BvyQ&callback=CreateMap"></script>
</body>

</html>