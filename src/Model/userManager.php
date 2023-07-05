<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'admin';
    public function create(string $username, string $password): void
    {
        $userPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (username, password) VALUES (:username, :password)");
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->bindValue('password', $userPassword, \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectOneByUsername(string $username): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE username=:username");
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->execute();
        $result  = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result ?: [];
    }
}
