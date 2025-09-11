<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Character.php';
require_once __DIR__ . '/../repository/CharacterRepository.php';

class CharacterController extends AppController {

    private $characterRepository;

    public function __construct() {
        parent::__construct();
        $this->characterRepository = new CharacterRepository();
    }

    public function add_character() {
        
        $professions = $this->characterRepository->getProfessions();
        $servers = $this->characterRepository->getServers();

        $this->render('add_character', [
            'professions' => $professions,
            'servers' => $servers
        ]);
    }


    public function boss_selection() {
        $professions = ['Druid', 'Voodoo', 'Mag Ognia', 'Rycerz', 'Sheed', 'Łucznik', 'Barbarzyńca'];
        $servers = ['Thanar', 'Veskara', 'Vardis'];
        $email = $_SESSION['user_email'] ?? null;
        if (!$email) {
            $characters = [];
        } else {
            $userRepository = new UserRepository();
            $user_id = $userRepository->getUserIdByEmail($email);

            if ($user_id) {
                $characters = $this->characterRepository->getCharactersByUserId($user_id);
            } else {
                $characters = [];
            }
        }

        $this->render('boss_selection', [
            'professions' => $professions,
            'servers' => $servers,
            'characters' => $characters
        ]);
    }


    public function add_character_post() {
        header('Content-Type: application/json');

        $nickname = $_POST['nickname'] ?? null;
        $level = $_POST['level'] ?? null;
        $profession = $_POST['profession'] ?? null;
        $server = $_POST['server'] ?? null;

        if (!$nickname || !$level || !$profession || !$server) {
            echo json_encode(['success' => false, 'message' => 'Wszystkie pola muszą być wypełnione!']);
            return;
        }

        $email = $_SESSION['user_email'] ?? null;
        if (!$email) {
            echo json_encode(['success' => false, 'message' => 'Nie jesteś zalogowany!']);
            return;
        }

        $userRepository = new UserRepository();
        $user_id = $userRepository->getUserIdByEmail($email);

        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'Nie udało się znaleźć użytkownika!']);
            return;
        }

        $character = new Character($user_id, $nickname, $level, $profession, $server);
        $this->characterRepository->addCharacter($character);

        echo json_encode(['success' => true]);
    }

}
