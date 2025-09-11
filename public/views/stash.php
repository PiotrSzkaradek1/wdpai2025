

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
    <link href="public/styles/stash.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    <script src="public/scripts/character_selection.js" defer></script>
    <script src="public/scripts/boss_selection.js" defer></script>
    <script src="public/scripts/stash.js" defer></script>

    <title>STASH</title>
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
        <?php foreach ($characters as $char): ?>
        <div class="card2 <?= ($char->getId() == $character->getId()) ? 'selected' : '' ?>"
             data-id="<?= $char->getId() ?>" 
             data-nickname="<?= $char->getNickname() ?>" 
             data-profession="<?= $char->getProfession() ?>" 
             data-level="<?= $char->getLevel() ?>" 
             data-server="<?= $char->getServer() ?>">
            <p><?= htmlspecialchars($char->getNickname()) ?></p>
            <p><?= htmlspecialchars($char->getProfession()) ?></p>
            <p><?= htmlspecialchars($char->getLevel()) ?></p>
            <p><?= htmlspecialchars($char->getServer()) ?></p>
        </div>
        <?php endforeach; ?>
    </section>

    <aside>
        <h2 class="aside-title">Wybierz bossa klikając w ikonkę poziomu trudności</h2>

        <?php 
        // tablica bossów do wygodnego generowania
        $bosses = [
            ['id'=>1,'name'=>'Ivravul','img'=>'public/images/Ivravul.png','difficulties'=>['Normal','Hard']],
            ['id'=>2,'name'=>'Jaskółka','img'=>'public/images/Jaska.png','difficulties'=>['Easy','Normal','Hard']],
            ['id'=>3,'name'=>'Konstrukt','img'=>'public/images/V2.png','difficulties'=>['Easy','Normal','Hard']],
            ['id'=>4,'name'=>'Admirał Utoru','img'=>'public/images/Admiral.png','difficulties'=>['Normal','Hard']],
        ];
        ?>

        <?php foreach ($bosses as $b): ?>
        <div class="boss-card">
            <img src="<?= $b['img'] ?>">
            <p><?= $b['name'] ?></p>
            <div class="difficulty-icons">
                <?php foreach ($b['difficulties'] as $diff): 
                    $isSelected = ($boss->getId() == $b['id'] && $boss->getDifficulty() == $diff) ? 'selected' : '';
                ?>
                <img src="public/images/<?= $diff ?>.png"
                     data-boss_id="<?= $b['id'] ?>"
                     data-boss="<?= $b['name'] ?>" 
                     data-difficulty="<?= $diff ?>" 
                     data-difficulty-img="public/images/<?= $diff ?>.png"
                     class="<?= $isSelected ?>">
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
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
            <img src="public/images/Herszt.png">
            <p>Tajemnicza postać</p>
            <img src="public/images/Easy.png" alt="difficulty-icon-select">
        </div>

        <div id="stash-summary">
            <p>Suma złota: <span id="sum-gold"><?= $totalGold ?></span></p>
            <p>Suma tropów: <span id="sum-tracks"><?= array_sum(array_column($totalTracks, 'total')) ?></span></p>

            <h4>Itemy (suma dla tego bossa):</h4>
            <table id="items-summary" class="summary-table">
                <thead>
                    <tr><th>Item</th><th>Ilość</th></tr>
                </thead>
                <tbody id="items-summary-body">
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['total'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="summary-buttons">
                <button id="show-rars">Pokaż Rary</button>
                <button id="show-syngs">Pokaż Synergetyki</button>
                <button id="show-drifs">Pokaż Drify</button>
            </div>

            <div id="modal-rars" class="modal" style="display:none;">
                <table>
                    <thead><tr><th>Rar</th><th>Quality</th><th>Ilość</th></tr></thead>
                    <tbody>
                    <?php foreach ($rars as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['name']) ?></td>
                            <td><?= $r['quality'] ?></td>
                            <td><?= $r['total'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="modal-syngs" class="modal" style="display:none;">
                <table>
                    <thead><tr><th>Tier</th><th>Ilość</th></tr></thead>
                    <tbody>
                    <?php foreach ($syngs as $s): ?>
                        <tr>
                            <td><?= $s['quality'] ?></td>
                            <td><?= $s['total'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="modal-drifs" class="modal" style="display:none;">
                <table>
                    <thead><tr><th>Drif</th><th>Tier</th><th>Ilość</th></tr></thead>
                    <tbody>
                    <?php foreach ($drifs as $d): ?>
                        <tr>
                            <td><?= htmlspecialchars($d['name']) ?></td>
                            <td><?= $d['tier'] ?></td>
                            <td><?= $d['total'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div id="modal-container"></div>
    </div>
</main>

<div id="all-rars" data-rars='<?= json_encode($rars) ?>' style="display:none;"></div>
<div id="all-drifs" data-drifs='<?= json_encode($drifs) ?>' style="display:none;"></div>

<script>

</script>

</body>
</html>
