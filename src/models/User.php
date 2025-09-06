<?php

class User{
    private $email;
    private $password_hash;

    public function __construct(string $email, string $password_hash){
        $this->email = $email;
        $this->password_hash = $password_hash;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password_hash;
    }

    public function setPassword(string $password_hash){
        $this->password_hash = $password_hash;
    }

    
}