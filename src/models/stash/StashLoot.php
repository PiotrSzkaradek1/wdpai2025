<?php

class StashLoot
{
    private int $recordId;
    private int $characterId;
    private int $bossId;

    public function __construct(int $recordId, int $characterId, int $bossId)
    {
        $this->recordId = $recordId;
        $this->characterId = $characterId;
        $this->bossId = $bossId;
    }

    public function getRecordId(): int { return $this->recordId; }
    public function getCharacterId(): int { return $this->characterId; }
    public function getBossId(): int { return $this->bossId; }
}
