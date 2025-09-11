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
    <link href="public/styles/add_character.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    <title>ADD CHARACTER</title>
</head>
<body>
    <nav class="flex-row-center-center">
        <ul class="desktop-icons">
            <li>
                <img src="public/images/logo_wht.png">
                <span>LOOT TRACKER</span>
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
            <h1>Dodaj nową postać</h1>
    <form action="add_character_post" method="POST" class="flex-column-center-center">

        <div class="form-control">
            <label for="nickname">Nick postaci</label>
            <input type="text" id="nickname" name="nickname" required>
        </div>

        <div class="form-control">
            <label for="level">Level</label>
            <input type="number" id="level" name="level" min="1" max="140" required>
        </div>

        <div class="form-control">
            <label for="profession">Profesja</label>
            <select id="profession" name="profession" required>
                <option value="">-- wybierz profesję --</option>
                <?php foreach ($professions as $p): ?>
                    <option value="<?= $p ?>"><?= ucfirst($p) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-control">
            <label for="server">Server</label>
            <select id="server" name="server" required>
                <option value="">-- wybierz serwer --</option>
                <?php foreach ($servers as $s): ?>
                    <option value="<?= $s ?>"><?= ucfirst($s) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">
            <i class="fa-solid fa-plus" style="color: #e5e9f0;"></i> Dodaj postać
        </button>
    </form>
        </section>
    </main>
    
</body>
</html>