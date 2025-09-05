<?php

require_once 'AppController.php';

class DefaultController extends AppController{

        public function index() {
            $this->render('login');
        }

        public function dashboard() {
            $this->render('dashboard');
        }

        public function boss_selection() {
            $this->render('boss_selection');
        }
        
}