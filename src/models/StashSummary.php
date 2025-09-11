<?php

class StashSummary {
    private int $gold;
    private int $tracks;
    /** @var StashItem[] */
    private array $items;
    private array $rars;
    private array $syngs;
    private array $drifs;

    public function __construct(int $gold, int $tracks, array $items, array $rars, array $syngs, array $drifs) {
        $this->gold = $gold;
        $this->tracks = $tracks;
        $this->items = $items;
        $this->rars = $rars;
        $this->syngs = $syngs;
        $this->drifs = $drifs;
    }

    public function getGold(): int { return $this->gold; }
    public function getTracks(): int { return $this->tracks; }
    public function getItems(): array { return $this->items; }
    public function getRars(): array { return $this->rars; }
    public function getSyngs(): array { return $this->syngs; }
    public function getDrifs(): array { return $this->drifs; }
}
