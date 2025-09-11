<?php

class StashDrif
{
    private int $id;
    private string $name;
    private string $tier;
    private int $count;

    public function __construct(int $id, string $name, string $tier, int $count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tier = $tier;
        $this->count = $count;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getTier(): string { return $this->tier; }
    public function getCount(): int { return $this->count; }
}
