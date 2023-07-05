<?php

namespace App\Service;

use App\Model\Connection;
use PDO;

class ValidateDevis
{
    private PDO $pdo;
    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function validateDevis($numeroCommande)
    {
        $query = 'update devis set  isValid = 1  where numeroCommande = :numeroCommande';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('numeroCommande', $numeroCommande);
        $statement->execute();
    }

    public function unValidateDevis($numeroCommande)
    {
        $query = 'update devis set  isValid = 0  where numeroCommande = :numeroCommande';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('numeroCommande', $numeroCommande);
        $statement->execute();
    }
}
