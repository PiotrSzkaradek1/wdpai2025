<?php
session_start();
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

// GET routes
Routing::get('index', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('boss_selection', 'DefaultController');
Routing::get('add_character', 'CharacterController');

// POST routes
Routing::post('add_character', 'CharacterController');
Routing::post('add_character_post', 'CharacterController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');

Routing::run($path);
