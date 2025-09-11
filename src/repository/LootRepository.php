<?php
// src/repository/LootRepository.php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Loot.php';

class LootRepository extends Repository {

    public function saveLoot(Loot $loot): void {
        $conn = $this->database->connect();
        try {
            $conn->beginTransaction();

            // 1. Główny rekord
            $stmt = $conn->prepare("
                INSERT INTO records (character_id, boss_id, difficulty, created_at)
                VALUES (:char, :boss, :difficulty, NOW())
                RETURNING id
            ");
            $stmt->execute([
                'char' => $loot->getCharacterId(),
                'boss' => $loot->getBossId(),
                'difficulty' => $loot->getDifficulty()
            ]);
            $recordId = $stmt->fetchColumn();

            // 2. Złoto
            if ($loot->getGold() > 0) {
                $stmt = $conn->prepare("
                    INSERT INTO record_gold (record_id, amount)
                    VALUES (:record, :amount)
                ");
                $stmt->execute([
                    'record' => $recordId,
                    'amount' => $loot->getGold()
                ]);
            }

            // 3. Tropy
            if ($loot->getTracks() > 0) {
                $stmt = $conn->prepare("
                    INSERT INTO record_trops (record_id, tier, amount)
                    VALUES (:record, :tier, :amount)
                ");
            
            foreach ($loot->getTracks() as $tier => $amount) {
                if ($amount > 0) {
                    $stmt->execute([
                        'record' => $recordId,
                        'tier' => $tier,
                        'amount' => $amount
                    ]);
                }
            }

            }

            // 4. Itemy
            $stmt = $conn->prepare("
                INSERT INTO record_items (record_id, item_id, amount)
                VALUES (:record, :item, :amount)
            ");
            foreach ($loot->getItems() as $itemId => $amount) {
                if ($amount > 0) {
                    $stmt->execute([
                        'record' => $recordId,
                        'item' => $itemId,
                        'amount' => $amount
                    ]);
                }
            }

            // 5. Rary
            $stmt = $conn->prepare("
                INSERT INTO record_rars (record_id, rar_id, quality)
                VALUES (:record, :rar, :quality)
            ");
            foreach ($loot->getRars() as $rar) {
                $stmt->execute([
                    'record' => $recordId,
                    'rar' => $rar['id'],
                    'quality' => $rar['quality']
                ]);
            }


            // 6. Synergetyki
            $stmt = $conn->prepare("
                INSERT INTO record_synergetics (record_id, tier)
                VALUES (:record, :tier)
            ");
            foreach ($loot->getSyngs() as $syng) {
                $stmt->execute([
                    'record' => $recordId,
                    'tier' => $syng['quality']  // albo zmień nazwę w bazie na quality
                ]);
            }


            // 7. Drify
            $stmt = $conn->prepare("
                INSERT INTO record_drifs (record_id, drif_id, tier)
                VALUES (:record, :drif, :tier)
            ");
            foreach ($loot->getDrifs() as $drif) {
                $stmt->execute([
                    'record' => $recordId,
                    'drif' => $drif['id'],
                    'tier' => $drif['tier']
                ]);
            }


            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}
