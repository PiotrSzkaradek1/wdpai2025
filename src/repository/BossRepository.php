<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Boss.php';

class BossRepository extends Repository {
    public function getBossById(int $id): Boss {
        $stmt = $this->database->connect()->prepare("
            SELECT *
            FROM bosses
            WHERE id = :id
        ");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Boss(
            (int)$row['id'],
            $row['name'],
            (int)$row['tier'],
            (int)$row['min_syng'],
            (int)$row['max_syng']
        );
    }

}
