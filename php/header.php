<header>
    <div class="header-section header-content">
        <div class="dropdown dropdown-select" id="menu">
            <div class="dropdown-trigger" id="menu-trigger">
                <i class="material-icons">menu</i>
            </div>
            <nav class="dropdown-content list" id="menu-content">
                <a class="list-item" id="menu-home"  href="./index.php">
                    <i class="material-icons list-icon">home</i>Home
                </a>
                <a class="list-item" id="menu-sign-in">
                    <i class="material-icons list-icon">person</i>Sign-in
                </a>
                <a class="list-item" id="menu-sign-up" href="./register.php">
                    <i class="material-icons list-icon">create</i>Sign-up
                </a>
            </nav>
        </div>

        <div id="header-logo">
            <a href="./fyw_results.html">
                <span>
                    <i class="material-icons">wifi</i>
                </span>
                <span>Find Your Wi-Fi</span>
            </a>
        </div>

        <div class="dropdown" id="search">
            <div class="dropdown-trigger" id="search-trigger">
                <i class="material-icons">search</i>
            </div>
            <div class="dropdown-content" id="search-content">
                <div class="load-container" id="search-load">
                    <div class="load-spinner"></div>
                </div>
                <form class="form" id="search-form" action="./index.php">
                    <div class="dropdown dropdown-select form-field" id="search-mode">
                        <div class="dropdown-trigger" id="search-mode-trigger">
                            <label>Search by</label>
                            <input name="searchMode" type="text" value="Name" class="required-input" readonly>
                        </div>
                        <div class="dropdown-content" id="search-mode-content">
                            <div class="list">
                                <a class="list-item">Name</a>
                                <a class="list-item">Nearby</a>
                                <a class="list-item">Suburb</a>
                                <a class="list-item">Rating</a>
                            </div>
                        </div>
                        <div class="form-error"></div>
                    </div>
                    <div class="form-field" id="search-field">
                        <label>Name</label>
                        <input type="text" placeholder="E.g. 7th Brigade Park, Chermside" name="searchName" class="required-input">
                        <div class="form-error"></div>
                    </div>
                    <div id="search-submit">
                        <input type="submit" value="Search" onclick="return ValidateForm('search-form');">
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>