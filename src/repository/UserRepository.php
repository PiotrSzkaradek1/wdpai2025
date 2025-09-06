<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    // Pobranie użytkownika po emailu
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            $data['email'],
            $data['password_hash']
        );
    }

    // Dodanie nowego użytkownika
    public function addUser(User $user): bool
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password_hash) VALUES (:email, :password)
        ');

        return $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword()
        ]);
    }

    public function getUserIdByEmail(string $email): ?int {
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['id'] : null;
    }
}
