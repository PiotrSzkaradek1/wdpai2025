<?php

require_once 'src/controllers/AppController.php';

class LogoutController extends AppController {
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $this->redirect('login'); // albo header("Location: login.php");
    }
}
