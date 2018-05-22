<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta data for iOS (was not working over HTTPS when testing but is fine over HTTP) -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" />

    <!-- Importing CSS -->
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/site_wide.css">
    <link rel="stylesheet" href="/css/about.css">
    <title>FYW - About us</title>
</head>

<body>
    <!-- Inporting header -->
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <div id="about-container">
            <p class="h1">About us</p>
            <p>This website allows you to browse Wifi hotspots around Brisbane and review them. Enjoy your stay!</p>
        </div>
    </main>
    <!-- Importing footer -->
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>
    <!-- Importing Scripts -->
    <script src="/js/site_wide.js"></script>
</body>

</html>