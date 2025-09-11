<?php

class StashSyng
{
    private int $id;
    private string $tier;
    private int $count;

    public function __construct(int $id, string $tier, int $count)
    {
        $this->id = $id;
        $this->tier = $tier;
        $this->count = $count;
    }

    public function getId(): int { return $this->id; }
    public function getTier(): string { return $this->tier; }
    public function getCount(): int { return $this->count; }
}
