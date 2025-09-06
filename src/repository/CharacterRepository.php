<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Character.php';

class CharacterRepository extends Repository {

    public function addCharacter(Character $character) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO characters (user_id, name, level, profession, server)
            VALUES (:user_id, :name, :level, :profession, :server)
        ');

        $stmt->execute([
            'user_id' => $character->getUserId(),
            'name' => $character->getName(),
            'level' => $character->getLevel(),
            'profession' => $character->getProfession(),
            'server' => $character->getServer()
        ]);
    }

    public function getProfessions(): array {
        // pobiera enum z bazy danych np. PostgreSQL
        $stmt = $this->database->connect()->query("
            SELECT unnest(enum_range(NULL::profession_enum)) AS profession
        ");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getServers(): array {
        $stmt = $this->database->connect()->query("
            SELECT unnest(enum_range(NULL::server_enum)) AS server
        ");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
