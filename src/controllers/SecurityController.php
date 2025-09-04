<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController {
    public function login() {
        $user = new User(email: 'kurwa@mac.pl', password: '1234', name: 'Jan', surname: 'Kowalski');
        
        if($this->isPost()){
            return $this->login('login');
        }

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist']]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

        //return $this->render('dashboard');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }
}