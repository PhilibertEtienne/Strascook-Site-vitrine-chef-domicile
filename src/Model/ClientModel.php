<?php

namespace App\Model;

use App\Model\AbstractManager;

class ClientModel extends AbstractManager
{
    public function addClient(array $client): void
    {
        $query = 'INSERT INTO client (prenom, nom, email, telephone, 
        -- date, nbconvives, 
        adresse_livraison, adresse_facturation) 
        VALUES (:prenom, :nom, :email, :telephone, 
        -- :date, :nbconvives, 
         :adresse_livraison, :adresse_facturation)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('prenom', $client['prenom'], \PDO::PARAM_STR);
        $statement->bindValue('nom', $client['nom'], \PDO::PARAM_STR);
        $statement->bindValue('email', $client['email'], \PDO::PARAM_STR);
        $statement->bindValue('telephone', $client['telephone'], \PDO::PARAM_STR);
        // $statement->bindValue('date', $client['date'], \PDO::PARAM_STR);
        // $statement->bindValue('nbconvives', $client['nbconvives'], \PDO::PARAM_INT);
        $statement->bindValue('adresse_livraison', $client['adresse_livraison'], \PDO::PARAM_STR);
        $statement->bindValue('adresse_facturation', $client['adresse_facturation'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectClient(): array
    {
        $query = 'SELECT * FROM client';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function selectLastClient(): array
    {
        $query = 'SELECT client_idclient FROM devis ORDER BY numeroCommande DESC LIMIT 1';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $query = 'SELECT * FROM client  where idclient = :idclient';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('idclient', $result['client_idclient'], \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function updateClientById($id): void
    {
        $query = 'UPDATE client SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, 
        -- date = :date, nbconvives = :nbconvives, 
        adresse_livraison = :adresse_livraison,
         adresse_facturation = :adresse_facturation WHERE idclient = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('prenom', $_POST['prenom'], \PDO::PARAM_STR);
        $statement->bindValue('nom', $_POST['nom'], \PDO::PARAM_STR);
        $statement->bindValue('email', $_POST['email'], \PDO::PARAM_STR);
        $statement->bindValue('telephone', $_POST['telephone'], \PDO::PARAM_STR);
        // $statement->bindValue('date', $_POST['date'], \PDO::PARAM_STR);
        // $statement->bindValue('nbconvives', $_POST['nbconvives'], \PDO::PARAM_INT);
        $statement->bindValue('adresse_livraison', $_POST['adresse_livraison'], \PDO::PARAM_STR);
        $statement->bindValue('adresse_facturation', $_POST['adresse_facturation'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function deleteClient(int $id): void
    {
        $query = 'DELETE FROM client WHERE idclient =:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
