<?php

class Boss {
    private $id;
    private $name;
    private $tier;
    private $minSyng;
    private $maxSyng;

    public function __construct(int $id, string $name, int $tier, int $minSyng, int $maxSyng) {
        $this->id = $id;
        $this->name = $name;
        $this->tier = $tier;
        $this->minSyng = $minSyng;
        $this->maxSyng = $maxSyng;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getTier(): int { return $this->tier; }
    public function getMinSyng(): int { return $this->minSyng; }
    public function getMaxSyng(): int { return $this->maxSyng; }
}
