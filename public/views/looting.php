<?php
$character = $_SESSION['selectedCharacter'] ?? null;
$boss = $_SESSION['selectedBoss'] ?? null;
/** @var array $character */
/** @var array $boss */
/** @var Boss $bossData */
/** @var Item[] $items */
/** @var Rar[] $rars */
/** @var Drif[] $drifs */
?>


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
    <link href="public/styles/looting.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    <script src="public/scripts/looting.js" defer></script>

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
        <section id="looting-info">
        <h3 class="extra-title">Twój wybór:</h3>

        <?php if ($character && $boss): ?>
            <div class="boss-select">
                <img src="<?= htmlspecialchars($boss['bossImg']) ?>" alt="<?= htmlspecialchars($boss['boss']) ?>">
                <p><?= htmlspecialchars($boss['boss']) ?></p>
                <img src="<?= htmlspecialchars($boss['difficultyImg']) ?>" alt="<?= htmlspecialchars($boss['difficulty']) ?>">
            </div>
            <div class="card-select">
                <p><?= htmlspecialchars($character['nickname']) ?></p>
                <p><?= htmlspecialchars($character['profession']) ?></p>
                <p><?= htmlspecialchars($character['level']) ?></p>
                <p><?= htmlspecialchars($character['server']) ?></p>
            </div>
        <?php else: ?>
            <p>Brak wybranych danych. Wróć do wyboru bossa i postaci.</p>
        <?php endif; ?>
        </section>
        <aside>
                <form id="lootForm">
                    <!-- Złoto i Tropy -->
                     
                    <label>Złoto: <input type="number" name="gold" value="0" min="0"></label><br>
                    <label>Tropy: <input type="number" name="tracks" value="0" min="0"></label><br>

                    <!-- Itemy -->
                    <h3>Itemy:</h3>
                    <?php foreach ($items as $item): ?>
                        <label>
                            <?= htmlspecialchars($item->getName()) ?>
                            <input type="number" class="item-input" name="items[<?= $item->getId() ?>]" data-id="<?= $item->getId() ?>" value="0" min="0">
                        </label><br>
                    <?php endforeach; ?>

                    <!-- Rary -->
                    <h3>Dodaj Rara:</h3>
                    <select id="rarSelect">
                        <option value="">-- wybierz rara --</option>
                        <?php foreach ($rars as $rar): ?>
                            <option value="<?= $rar->getId() ?>"><?= htmlspecialchars($rar->getName()) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="rarQuality">
                        <?php for ($i = 1; $i <= 9; $i++): ?>
                            <option value="<?= $i ?>">Jakość <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="button" id="addRar">Dodaj Rara</button>

                    <!-- Synergetyki -->
                    <h3>Dodaj Synergetyk:</h3>
                    <select id="syngQuality">
                        <?php for ($i = $bossData->getMinSyng(); $i <= $bossData->getMaxSyng(); $i++): ?>
                            <option value="<?= $i ?>">Jakość <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="button" id="addSyng">Dodaj Synergetyk</button>

                    <!-- Drify -->
                    <h3>Dodaj Drifa:</h3>
                    <select id="drifType">
                        <option value="">-- wybierz drifa --</option>
                        <?php foreach ($drifs as $drif): ?>
                            <option value="<?= $drif->getId() ?>"><?= htmlspecialchars($drif->getName()) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="drifTier">
                        <?php for ($i = 1; $i <= $bossData->getTier(); $i++): ?>
                            <option value="<?= $i ?>">Tier <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="button" id="addDrif">Dodaj Drifa</button>

                    <!-- Koszyk -->
                    <h3>Elementy ekwipunku:</h3>
                    <ul id="loot-cart"></ul>

                    <button type="submit" id="saveLoot">Zapisz loot</button>
                </form>
        </aside>
        <div class="extra">
            
        </div>
    </main>
</body>
</html>
