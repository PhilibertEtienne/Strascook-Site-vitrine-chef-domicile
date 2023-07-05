<?php

namespace App\Service;

use App\Model\Connection;
use PDO;

class GetCommandeById
{
    private PDO $pdo;
    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function getCommandeById($id): array
    {
        $query = 'SELECT * FROM client WHERE idclient = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
