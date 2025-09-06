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
    <link href="public/styles/boss_selection.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    <script src="public/scripts/add_character_modal.js" defer></script>
    <script src="public/scripts/character_selection.js" defer></script>
    <script src="public/scripts/boss_selection.js" defer></script>


    <title>BOSS_SELECTION</title>
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
            <p>Wybierz lub dodaj postać: </p>
            <div class="card" id="openAddCharacterModal">
                <i class="fa-solid fa-plus"></i>
                <p>Dodaj postać</p>
            </div>
            
            <?php foreach ($characters as $char): ?>
            <div class="card2" data-id="<?= $char->getId() ?>" 
                data-nickname="<?= $char->getName() ?>" 
                data-profession="<?= $char->getProfession() ?>" 
                data-level="<?= $char->getLevel() ?>" 
                data-server="<?= $char->getServer() ?>">
                <p><?= htmlspecialchars($char->getName()) ?></p>
                <p><?= htmlspecialchars($char->getProfession()) ?></p>
                <p><?= htmlspecialchars($char->getLevel()) ?></p>
                <p><?= htmlspecialchars($char->getServer()) ?></p>
            </div>
        <?php endforeach; ?>

        </section>
        <aside>
            <h2 class="aside-title">Wybierz bossa klikając w ikonkę poziomu trudności</h2>
            <div class="boss-card">
                <img src="public/images/Ivravul.png">
                <p>Ivravul</p>
                <div class="difficulty-icons">
                    <!--<img src="public/images/Easy.png">-->
                    <img src="public/images/Normal.png"
                        data-boss="Ivravul" 
                        data-difficulty="Normal" 
                        data-difficulty-img="public/images/Normal.png">
                    <img src="public/images/Hard.png"
                        data-boss="Ivravul" 
                        data-difficulty="Hard" 
                        data-difficulty-img="public/images/Hard.png">  
                </div>    
            </div>
            <div class="boss-card">
                <img src="public/images/Jaska.png">
                <p>Jaskółka</p>
                <div class="difficulty-icons">
                    <img src="public/images/Easy.png"
                    data-boss="Jaskółka" 
                    data-difficulty="Easy" 
                    data-difficulty-img="public/images/Easy.png">
                    <img src="public/images/Normal.png"
                    data-boss="Jaskółka" 
                    data-difficulty="Normal" 
                    data-difficulty-img="public/images/Normal.png">
                    <img src="public/images/Hard.png"
                    data-boss="Jaskółka" 
                    data-difficulty="Hard" 
                    data-difficulty-img="public/images/Hard.png">  
                </div>      
            </div>
            <div class="boss-card">
                <img src="public/images/V2.png">
                <p>Konstrukt</p>
                <div class="difficulty-icons">
                    <img src="public/images/Easy.png"
                    data-boss="Konstrukt" 
                    data-difficulty="Easy" 
                    data-difficulty-img="public/images/Easy.png">
                    <img src="public/images/Normal.png"
                    data-boss="Konstrukt" 
                    data-difficulty="Normal" 
                    data-difficulty-img="public/images/Normal.png">
                    <img src="public/images/Hard.png"
                    data-boss="Konstrukt" 
                    data-difficulty="Hard" 
                    data-difficulty-img="public/images/Hard.png">  
                </div>      
            </div>
            <div class="boss-card">
                <img src="public/images/Admiral.png">
                <p>Admirał Utoru</p>
                <div class="difficulty-icons">
                    <!--<img src="public/images/Easy.png">-->
                    <img src="public/images/Normal.png"
                    data-boss="Admirał Utoru" 
                    data-difficulty="Normal" 
                    data-difficulty-img="public/images/Normal.png">
                    <img src="public/images/Hard.png"
                    data-boss="Admirał Utoru" 
                    data-difficulty="Hard" 
                    data-difficulty-img="public/images/Hard.png">  
                </div>      
            </div>
        </aside>
        <div class="extra">
            <h3 class="extra-title">Twój wybór:</h3>
            <div class="card-select">
                <p>Nickname</p>
                <p>Klasa</p>
                <p>lvl</p>
                <p>Server</p>
            </div>
            <div class="boss-select">
                <img src="public/images/V2.png">
                <p>Konstrukt</p>
                <img src="public/images/Easy.png" alt="difficulty-icon-select">
            </div>
            <div class="card-continue">
                <p>Przejdź do zbierania</p>
            </div>
        </div>
    </main>
    
<div id="character-modal">
  <form id="add-character-form" class="flex-column-center-center">
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
              <?php foreach ($professions as $p): ?>
                  <option value="<?= $p ?>"><?= ucfirst($p) ?></option>
              <?php endforeach; ?>
          </select>
      </div>

      <div class="form-control">
          <label for="server">Server</label>
          <select id="server" name="server" required>
              <?php foreach ($servers as $s): ?>
                  <option value="<?= $s ?>"><?= ucfirst($s) ?></option>
              <?php endforeach; ?>
          </select>
      </div>

      <button type="submit">
          <i class="fa-solid fa-plus"></i> Dodaj postać
      </button>
  </form>
</div>


</body>
</html>
