<?php

class Character {
    private $user_id;
    private $name;
    private $level;
    private $profession;
    private $server;
    private $id;

    public function __construct($user_id, $name, $level, $profession, $server, $id = null) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->level = $level;
        $this->profession = $profession;
        $this->server = $server;
        $this->id = $id;
    }

    public function getUserId() { return $this->user_id; }
    public function getName() { return $this->name; }
    public function getLevel() { return $this->level; }
    public function getProfession() { return $this->profession; }
    public function getServer() { return $this->server; }
    public function getId() { return $this->id; }
}
