<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Drif.php';

class DrifRepository extends Repository {
    public function getAllDrifs(): array {
        $stmt = $this->database->connect()->query("SELECT id, name FROM drifs ORDER BY id");

        $drifs = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $drifs[] = new Drif((int)$row['id'], $row['name']);
        }
        return $drifs;
    }
}
