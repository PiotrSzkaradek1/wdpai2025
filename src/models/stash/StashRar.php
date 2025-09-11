<?php

class StashRar
{
    private int $id;
    private string $name;
    private string $quality;
    private int $count;

    public function __construct(int $id, string $name, string $quality, int $count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quality = $quality;
        $this->count = $count;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getQuality(): string { return $this->quality; }
    public function getCount(): int { return $this->count; }
}
