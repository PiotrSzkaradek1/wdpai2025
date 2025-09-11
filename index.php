<?php
session_start();
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

// GET routes
Routing::get('index', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('stash', 'StashController');
Routing::get('boss_selection', 'CharacterController');
Routing::get('add_character', 'CharacterController');
Routing::get('looting', 'LootController');
Routing::get('logout', 'SecurityController');

// POST routes
Routing::post('add_character', 'CharacterController');
Routing::post('add_character_post', 'CharacterController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('save_loot', 'LootController');
Routing::post('get_boss_stats', 'StashController');
Routing::post('save_selection', 'StashController');


Routing::run($path);
