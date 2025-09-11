<?php
require_once __DIR__ . '/../repository/StashRepository.php';
require_once __DIR__ . '/../models/stash/StashCharacter.php';
require_once __DIR__ . '/../models/stash/StashBoss.php';
require_once __DIR__ . '/../models/stash/StashLoot.php';
require_once __DIR__ . '/../models/stash/StashItem.php';
require_once __DIR__ . '/../models/stash/StashRar.php';
require_once __DIR__ . '/../models/stash/StashSyng.php';
require_once __DIR__ . '/../models/stash/StashDrif.php';

class StashController extends AppController
{
    private StashRepository $repo;

    public function __construct()
    {
        $this->repo = new StashRepository();
    }

    public function stash(): void
    {

        $userId = $this->repo->getUserIdByEmail($_SESSION['user_email'] ?? '');
        if (!$userId) die("Nie znaleziono użytkownika w bazie danych.");

        $characters = $this->repo->getCharactersByUser($userId);

        $charData = $_SESSION['selectedCharacter'] ?? null;
        $bossData = $_SESSION['selectedBoss'] ?? null;

        if (!$charData && !empty($characters)) {
            $firstChar = $characters[0];
            $charData = [
                'id' => $firstChar->getId(),
                'nickname' => $firstChar->getNickname(),
                'profession' => $firstChar->getProfession(),
                'level' => $firstChar->getLevel(),
                'server' => $firstChar->getServer()
            ];
            $_SESSION['selectedCharacter'] = $charData;
        }

        $charData = array_merge([
            'id' => 0,
            'nickname' => '',
            'profession' => '',
            'level' => '0',
            'server' => ''
        ], $charData);

        $character = new StashCharacter(
            $charData['id'],
            $charData['nickname'],
            $charData['profession'],
            $charData['level'],
            $charData['server']
        );

 
        if (!$bossData) {
            $bossData = ['id'=>1,'boss'=>'Ivravul','difficulty'=>'Normal'];
            $_SESSION['selectedBoss'] = $bossData;
        }

        $bossData = array_merge([
            'id' => 0,
            'boss' => '',
            'difficulty' => 'Normal'
        ], $bossData);

        $boss = new StashBoss(
            $bossData['id'],
            $bossData['boss'],
            $bossData['difficulty']
        );

 
        $totalGold   = $this->repo->getTotalGold($character, $boss);
        $totalTracks = $this->repo->getTotalTracks($character, $boss);
        $items       = $this->repo->getAllItems($character, $boss);
        $rars        = $this->repo->getRars($character, $boss);
        $syngs       = $this->repo->getSyngs($character, $boss);
        $drifs       = $this->repo->getDrifs($character, $boss);

        require __DIR__ . '/../../public/views/stash.php';
    }

    public function get_boss_stats(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            echo json_encode(['status' => 'error', 'msg' => 'Brak danych']);
            return;
        }

        $character = new StashCharacter(
            $input['character_id'] ?? 0,
            '',
            '',
            0,
            ''
        );
        $boss = new StashBoss(
            $input['boss_id'] ?? 0,
            '',
            $input['difficulty'] ?? 'Normal'
        );

        $data = [
            'status' => 'ok',
            'gold' => $this->repo->getTotalGold($character, $boss),
            'tracks_total' => array_sum(array_column($this->repo->getTotalTracks($character, $boss), 'total')),
            'items' => $this->repo->getAllItems($character, $boss),
            'rars' => $this->repo->getRars($character, $boss),
            'syngs' => $this->repo->getSyngs($character, $boss),
            'drifs' => $this->repo->getDrifs($character, $boss)
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function save_selection(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            echo json_encode(['status' => 'error', 'msg' => 'Brak danych']);
            return;
        }

        if (isset($input['character'])) {
            $_SESSION['selectedCharacter'] = array_merge([
                'id' => 0,
                'nickname' => '',
                'profession' => '',
                'level' => '0',
                'server' => ''
            ], $input['character']);
        }

        if (isset($input['boss'])) {
            $_SESSION['selectedBoss'] = array_merge([
                'id' => 0,
                'boss' => '',
                'difficulty' => 'Normal'
            ], $input['boss']);
        }

        echo json_encode(['status' => 'ok']);
    }
}
