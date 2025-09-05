<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController {
    public function login() {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = new User(email: 'kurwa@mac.pl', password: '1234', name: 'Jan', surname: 'Kowalski');

        // Sprawdzenie email
        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist']]);
        }

        // Sprawdzenie hasła
        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

        // Redirect do dashboard
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
        exit; // WAŻNE! Zatrzymuje wykonywanie skryptu po redirect
    }
}