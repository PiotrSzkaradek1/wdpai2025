<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Item.php';

class ItemRepository extends Repository {
    public function getItemsForBoss(int $bossId): array {
        $stmt = $this->database->connect()->prepare("
            SELECT i.id, i.name
            FROM items i
            JOIN boss_items bi ON i.id = bi.item_id
            WHERE bi.boss_id = :boss_id
        ");
        $stmt->execute(['boss_id' => $bossId]);

        $items = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $items[] = new Item((int)$row['id'], $row['name']);
        }
        return $items;
    }
     public function getItemsByBossId(int $bossId): array {
        $stmt = $this->database->connect()->prepare(
            'SELECT i.id, i.name 
             FROM items i
             JOIN boss_items bi ON bi.item_id = i.id
             WHERE bi.boss_id = :boss_id'
        );
        $stmt->execute(['boss_id' => $bossId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($result as $row) {
            $items[] = new Item($row['id'], $row['name']);
        }
        return $items;
    }

    public function insertLoot(int $characterId, int $itemId, int $quantity): void {
        if ($quantity <= 0) return;
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO character_loot_items (character_id, item_id, quantity) VALUES (:character_id, :item_id, :quantity)'
        );
        $stmt->execute([
            'character_id' => $characterId,
            'item_id' => $itemId,
            'quantity' => $quantity
        ]);
    }
}
