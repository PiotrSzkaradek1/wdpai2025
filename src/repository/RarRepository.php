<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Rar.php';

class RarRepository extends Repository {
    public function getRarsByBossId(int $bossId): array {
        $stmt = $this->database->connect()->prepare("
            SELECT id, name
            FROM rars
            WHERE boss_id = :boss_id
        ");
        $stmt->execute(['boss_id' => $bossId]);

        $rars = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $rars[] = new Rar((int)$row['id'], $row['name']);
        }
        return $rars;
    }
}
