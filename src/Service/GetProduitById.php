<?php

namespace App\Service;

use App\Model\Connection;
use PDO;

class GetProduitById
{
    private PDO $pdo;
    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function getProduitById($id): array
    {
        $query = 'SELECT * FROM produit WHERE idproduit = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
