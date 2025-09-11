<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/stash/StashCharacter.php';
require_once __DIR__ . '/../models/stash/StashBoss.php';

class StashRepository extends Repository
{
    public function getTotalGold(StashCharacter $character, StashBoss $boss): int
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT COALESCE(SUM(rg.amount), 0) as total
            FROM records r
            JOIN record_gold rg ON rg.record_id = r.id
            WHERE r.character_id = :charId
              AND r.boss_id = :bossId
              AND r.difficulty = :difficulty
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return (int) $stmt->fetchColumn();
    }

    public function getTotalTracks(StashCharacter $character, StashBoss $boss): array
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT rt.tier, SUM(rt.amount) as total
            FROM records r
            JOIN record_trops rt ON rt.record_id = r.id
            WHERE r.character_id = :charId
              AND r.boss_id = :bossId
              AND r.difficulty = :difficulty
            GROUP BY rt.tier
            ORDER BY rt.tier
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllItems(StashCharacter $character, StashBoss $boss): array
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT i.id, i.name, COALESCE(SUM(ri.amount), 0) as total
            FROM boss_items bi
            JOIN items i ON i.id = bi.item_id
            LEFT JOIN records r ON r.boss_id = bi.boss_id AND r.character_id = :charId AND r.difficulty = :difficulty
            LEFT JOIN record_items ri ON ri.record_id = r.id AND ri.item_id = bi.item_id
            WHERE bi.boss_id = :bossId
            GROUP BY i.id, i.name
            ORDER BY i.name
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRars(StashCharacter $character, StashBoss $boss): array
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT rr.rar_id, rars.name, rr.quality, COUNT(*) as total
            FROM records r
            JOIN record_rars rr ON rr.record_id = r.id
            JOIN rars ON rars.id = rr.rar_id
            WHERE r.character_id = :charId
              AND r.boss_id = :bossId
              AND r.difficulty = :difficulty
            GROUP BY rr.rar_id, rars.name, rr.quality
            ORDER BY rars.name, rr.quality
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSyngs(StashCharacter $character, StashBoss $boss): array
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT rs.tier as quality, COUNT(*) as total
            FROM records r
            JOIN record_synergetics rs ON rs.record_id = r.id
            WHERE r.character_id = :charId
              AND r.boss_id = :bossId
              AND r.difficulty = :difficulty
            GROUP BY rs.tier
            ORDER BY rs.tier
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDrifs(StashCharacter $character, StashBoss $boss): array
    {
        $conn = $this->database->connect();

        $stmt = $conn->prepare("
            SELECT rd.drif_id, drifs.name, rd.tier, COUNT(*) as total
            FROM records r
            JOIN record_drifs rd ON rd.record_id = r.id
            JOIN drifs ON drifs.id = rd.drif_id
            WHERE r.character_id = :charId
              AND r.boss_id = :bossId
              AND r.difficulty = :difficulty
            GROUP BY rd.drif_id, drifs.name, rd.tier
            ORDER BY drifs.name, rd.tier
        ");
        $stmt->execute([
            'charId' => $character->getId(),
            'bossId' => $boss->getId(),
            'difficulty' => $boss->getDifficulty()
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCharactersByUser(int $userId): array
    {
        $conn = $this->database->connect();
        $stmt = $conn->prepare("SELECT * FROM characters WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $characters = [];
        foreach ($rows as $r) {
            $characters[] = new StashCharacter(
                $r['id'],
                $r['name'],
                $r['profession'],
                $r['level'],
                $r['server']
            );
        }
        return $characters;
    }

    public function getUserIdByEmail(string $email): ?int
    {
        $conn = $this->database->connect();
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['id'] : null;
    }
}
