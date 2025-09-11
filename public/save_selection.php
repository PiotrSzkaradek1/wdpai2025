<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if(!$data || !isset($data['character']) || !isset($data['boss'])) {
    echo json_encode(['status' => 'error', 'msg' => 'Brak danych']);
    exit;
}

if (isset($data['character']['id'])) {
    $data['character']['id'] = (int)$data['character']['id'];
}

if (isset($data['boss']['id'])) {
    $data['boss']['id'] = (int)$data['boss']['id'];
}

// Zapis do sesji
$_SESSION['selectedCharacter'] = $data['character'];
$_SESSION['selectedBoss'] = $data['boss'];

echo json_encode(['status' => 'ok']);
