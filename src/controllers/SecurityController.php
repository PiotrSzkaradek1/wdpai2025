<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();

        // Start sesji jeśli jeszcze nie rozpoczęta
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userRepository->getUser($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Invalid email or password']]);
        }

        // Logowanie udane – zapis do sesji
        $_SESSION['user_email'] = $user->getEmail();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
        exit;
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmedPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords do not match']]);
        }

        // Sprawdzenie czy użytkownik już istnieje
        if ($this->userRepository->getUser($email)) {
            return $this->render('register', ['messages' => ['User already exists']]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedPassword);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You have been successfully registered!']]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $url = "http://$_SERVER[HTTP_HOST]/index"; 
        header("Location: {$url}");
        exit();
    }

}
