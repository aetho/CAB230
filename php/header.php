<!-- Start session -->
<?php session_start(); ?>

<!-- Header container -->
<header>
    <!-- Header section container -->
    <div class="header-section header-content">
        <!-- Menu container -->
        <div class="dropdown dropdown-select" id="menu">
            <!-- Menu trigger/button -->
            <div class="dropdown-trigger" id="menu-trigger">
                <i class="material-icons">menu</i>
            </div>
            <!-- Menu content/list -->
            <nav class="dropdown-content list" id="menu-content">
                <a class="list-item" id="menu-home"  href="/index.php">
                    <i class="material-icons list-icon">home</i>Home
                </a>
                <?php
                    // if user is not logged in then show log-in and register buttons
                    // else show logout button
                    if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
                        echo'<a class="list-item" id="menu-sign-in" href="/login.php">'.
                                '<i class="material-icons list-icon">person</i>Login'.
                            '</a>';

                        echo'<a class="list-item" id="menu-sign-up" href="/register.php">'.
                                '<i class="material-icons list-icon">create</i>Register'.
                            '</a>';
                    }else{
                        echo'<a class="list-item" id="menu-sign-up" href="/php/logout.php">'.
                                '<i class="material-icons list-icon">clear</i>Logout'.
                            '</a>';
                    }
                ?>
            </nav>
        </div>

        <!-- Logo container -->
        <div id="header-logo">
            <a href="/index.php">
                <span>
                    <i class="material-icons">wifi</i>
                </span>
                <span>Find Your Wi-Fi</span>
            </a>
        </div>

        <!-- Search dropdown container -->
        <div class="dropdown" id="search">
            <!-- Search dropdown trigger/button -->
            <div class="dropdown-trigger" id="search-trigger">
                <i class="material-icons">search</i>
            </div>
            <!-- Search dropdown content -->
            <div class="dropdown-content" id="search-content">
                <!-- A Loading container which will be used while retrieving suburbs from database -->
                <div class="load-container" id="search-load">
                    <div class="load-spinner"></div>
                </div>
                <!-- Form container for search form -->
                <form class="form" id="search-form" action="/index.php">
                    <!-- search mode dropdown container -->
                    <div class="dropdown dropdown-select form-field" id="search-mode">
                        <!-- search mode dropdown trigger -->
                        <div class="dropdown-trigger" id="search-mode-trigger">
                            <label>Search by</label>
                            <input name="searchMode" type="text" value="Name" class="required-input" readonly>
                        </div>
                        <!-- searhc mode content/options -->
                        <div class="dropdown-content" id="search-mode-content">
                            <div class="list">
                                <a class="list-item">Name</a>
                                <a class="list-item">Nearby</a>
                                <a class="list-item">Suburb</a>
                                <a class="list-item">Rating</a>
                            </div>
                        </div>
                        <!-- form error container -->
                        <div class="form-error"></div>
                    </div>
                    <!-- search input container (is filled with the appropriate elements based on search mode, using JavaScript) -->
                    <div class="form-field" id="search-field">
                        <label>Name</label>
                        <input type="text" placeholder="E.g. 7th Brigade Park, Chermside" name="searchName" class="required-input">
                        <div class="form-error"></div>
                    </div>
                    <!-- search submit button -->
                    <div id="search-submit">
                        <input type="submit" value="Search" onclick="return ValidateForm('search-form');">
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>