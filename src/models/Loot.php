<?php
// src/models/Loot.php

class Loot {
    private int $characterId;
    private int $bossId;
    private int $gold;
    private array $tracks;   // [tier => amount]
    private array $items;    // [item_id => quantity]
    private array $rars;     // [[rar_id, quality], ...]
    private array $syngs;    // [quality, ...]
    private array $drifs;    // [[drif_id, tier], ...]
    private string $difficulty;

    public function __construct(
        int $characterId,
        int $bossId,
        int $gold,
        array $tracks,
        array $items,
        array $rars,
        array $syngs,
        array $drifs,
        string $difficulty
    ) {
        $this->characterId = $characterId;
        $this->bossId = $bossId;
        $this->gold = $gold;
        $this->tracks = $tracks;
        $this->items = $items;
        $this->rars = $rars;
        $this->syngs = $syngs;
        $this->drifs = $drifs;
        $this->difficulty = $difficulty;
    }

    public function getCharacterId(): int { return $this->characterId; }
    public function getBossId(): int { return $this->bossId; }
    public function getGold(): int { return $this->gold; }
    public function getTracks(): array { return $this->tracks; }
    public function getItems(): array { return $this->items; }
    public function getRars(): array { return $this->rars; }
    public function getSyngs(): array { return $this->syngs; }
    public function getDrifs(): array { return $this->drifs; }
    public function getDifficulty(): string { return $this->difficulty; }
}
