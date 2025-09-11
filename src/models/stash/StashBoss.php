<?php

class StashBoss
{
    private int $id;
    private string $boss;
    private string $difficulty;

    public function __construct(int $id, string $boss, string $difficulty)
    {
        $this->id = $id;
        $this->boss = $boss;
        $this->difficulty = $difficulty;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->boss; }
    public function getDifficulty(): string { return $this->difficulty; }
}