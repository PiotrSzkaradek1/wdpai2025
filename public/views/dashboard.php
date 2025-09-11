<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b7c75b547d.js" crossorigin="anonymous"></script>
    
    <link href="public/styles/main.css" rel="stylesheet">
    <link href="public/styles/dashboard.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    <title>DASHBOARD</title>
</head>
<body>
    <nav class="flex-row-center-center">
        <ul class="desktop-icons">
            <li>
                <img src="public/images/logo_wht.png">
                <span>LOOT TRACKER</span>
            </li>
            <li>
            <a href="logout.php" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <a href="logout" class="logout-btn">Wyloguj</a>

            </a>
        </li>
        </ul>
        <ul class="mobile-icons">
            <li id="hamburger-menu">
                <i class="fa-solid fa-bars"></i>
                <span>MENU</span>
            </li>
        </ul>
    </nav>
    <main>
        <section>
            <!-- SECTION -->
                <div class="card">
                    <a href="boss_selection" class="card-link"></a>
                    <img src="public/images/keyarttlo.jpg">
                    <p>Rozpocznij zbieranie</p>
                </div>
            <div class="card">
                <a href="stash" class="card-link"></a>
                <img src="public/images/horseshoe.jpg">
                <p>Twój loot</p>
            </div>
        </section>
        <aside>
            ASIDE
        </aside>
    </main>
    
</body>
</html>