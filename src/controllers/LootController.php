<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/LootRepository.php';
require_once __DIR__ . '/../models/Loot.php';
require_once __DIR__ . '/../repository/BossRepository.php';
require_once __DIR__ . '/../repository/ItemRepository.php';
require_once __DIR__ . '/../repository/RarRepository.php';
require_once __DIR__ . '/../repository/DrifRepository.php';

class LootController extends AppController
{
    private LootRepository $lootRepository;
    private BossRepository $bossRepository;
    private ItemRepository $itemRepository;
    private RarRepository $rarRepository;
    private DrifRepository $drifRepository;

    public function __construct()
    {
        parent::__construct();
        $this->lootRepository = new LootRepository();
        $this->bossRepository = new BossRepository();
        $this->itemRepository = new ItemRepository();
        $this->rarRepository = new RarRepository();
        $this->drifRepository = new DrifRepository();
    }

    // 🔹 do wyświetlania widoku
    public function looting(): void
    {
        $character = $_SESSION['selectedCharacter'] ?? null;
        $boss = $_SESSION['selectedBoss'] ?? null;

        if (!$character || !$boss) {
            $this->render('looting', ['character' => null, 'boss' => null]);
            return;
        }

        $bossData = $this->bossRepository->getBossById((int)$boss['id']);
        $items = $this->itemRepository->getItemsByBossId((int)$boss['id']);
        $rars = $this->rarRepository->getRarsByBossId((int)$boss['id']);
        $drifs = $this->drifRepository->getAllDrifs();

        $this->render('looting', [
            'character' => $character,
            'boss' => $boss,
            'bossData' => $bossData,
            'items' => $items,
            'rars' => $rars,
            'drifs' => $drifs
        ]);
    }

    // 🔹 do zapisywania lootu
    public function save_loot(): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            echo json_encode(['status' => 'error', 'msg' => 'Brak danych']);
            return;
        }

        $character = $_SESSION['selectedCharacter'] ?? null;
        $boss = $_SESSION['selectedBoss'] ?? null;
        $difficulty = $boss['difficulty'] ?? 'normal';

        if (!$character || !$boss) {
            echo json_encode(['status' => 'error', 'msg' => 'Brak wybranej postaci lub bossa']);
            return;
        }

        $loot = new Loot(
            (int)$character['id'],
            (int)$boss['id'],
            (int)($data['gold'] ?? 0),
            $data['tracks'] ?? [],
            $data['items'] ?? [],
            $data['rars'] ?? [],
            $data['syngs'] ?? [],
            $data['drifs'] ?? [],
            $difficulty
        );

        try {
            $this->lootRepository->saveLoot($loot);
            echo json_encode(['status' => 'ok']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}
