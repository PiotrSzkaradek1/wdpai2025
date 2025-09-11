<?php

class StashItem
{
    private int $id;
    private string $name;
    private int $amount;

    public function __construct(int $id, string $name, int $amount = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getAmount(): int { return $this->amount; }
}
