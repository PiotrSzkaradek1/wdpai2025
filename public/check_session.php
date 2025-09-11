<?php
session_start();
header("Content-Type: application/json");

echo json_encode([
    "user_email" => $_SESSION['user_email'] ?? null,
    "selectedCharacter" => $_SESSION['selectedCharacter'] ?? null,
    "selectedBoss" => $_SESSION['selectedBoss'] ?? null
]);
