<?php

class StashCharacter
{
    private int $id;
    private string $nickname;
    private string $profession;
    private int $level;
    private string $server;

    public function __construct(int $id, string $nickname, string $profession, int $level, string $server)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->profession = $profession;
        $this->level = $level;
        $this->server = $server;
    }

    public function getId(): int { return $this->id; }
    public function getNickname(): string { return $this->nickname; }
    public function getProfession(): string { return $this->profession; }
    public function getLevel(): int { return $this->level; }
    public function getServer(): string { return $this->server; }
}
