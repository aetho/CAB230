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
    <div class="multi-pulse-container">
        <div class="pulse"></div>
    </div>
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
        <form class="form" id="sign-up-form">
            <div class="form-field" id="first-name-field">
                <label class="h5">First Name</label>
                <input type="text" placeholder="John" class="text-only-input required-input">
                <div class="form-error"></div>
            </div>
            <div class="form-field" id="last-name-field">
                <label class="h5">Last Name</label>
                <input type="text" placeholder="Smith" class="text-only-input required-input">
                <div class="form-error"></div>
            </div>
            <div class="form-field" id="email-field">
                <label class="h5">Email</label>
                <input type="text" placeholder="john@email.com" class="email-input required-input">
                <div class="form-error"></div>
            </div>
            <div class="form-field" id="password-field">
                <label class="h5">Password</label>
                <input type="password" placeholder="Password" class="password-input required-input">
                <div class="form-error"></div>
            </div>
            <div class="form-field" id="password-confirm-field">
                <label class="h5">Confirm Password</label>
                <input type="password" placeholder="Confirm password" class="password-confirm-input required-input">
                <div class="form-error"></div>
            </div>
            <div class="form-field" id="submit-field">
                <input type="submit" value="Sign up" onclick="ValidateForm('sign-up-form'); return false;">
            </div>
        </form>
    </main>
    <?php require(dirname(__FILE__)."/php/footer.php"); ?>    
    <script src="./js/site_wide.js"></script>
</body>

</html>