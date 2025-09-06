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
        
        // GET: wyświetlenie formularza
        $professions = $this->characterRepository->getProfessions();
        $servers = $this->characterRepository->getServers();

        $this->render('add_character', [
            'professions' => $professions,
            'servers' => $servers
        ]);
    }

    public function add_character_post() {
        // POST: zapis do bazy
        $nickname = $_POST['nickname'] ?? null;
        $level = $_POST['level'] ?? null;
        $profession = $_POST['profession'] ?? null;
        $server = $_POST['server'] ?? null;

        if (!$nickname || !$level || !$profession || !$server) {
            $messages[] = "Wszystkie pola muszą być wypełnione!";
            return $this->add_character();
        }

        $email = $_SESSION['user_email'] ?? null;
        if (!$email) {
            die("Nie jesteś zalogowany!");
        }

        $userRepository = new UserRepository();
        $user_id = $userRepository->getUserIdByEmail($email);

        if (!$user_id) {
            die("Nie udało się znaleźć użytkownika!");
        }

        $character = new Character($user_id, $nickname, $level, $profession, $server);
        $this->characterRepository->addCharacter($character);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/boss_selection");
        exit;
    }
}
