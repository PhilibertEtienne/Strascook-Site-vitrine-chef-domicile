<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class CommandeModel extends AbstractManager
{
    private const CLIENT_VALUE_QUERY = 'client (prenom, nom, email,
telephone, adresse_livraison, adresse_facturation)
VALUES (:prenom, :nom, :email, :telephone, :adresse_livraison, :adresse_facturation)';


    public function registerClient(array $lastClient): void
    {
        $isAlreadyClient = $this->pdo->prepare("SELECT COUNT(*) FROM client WHERE email = :email");
        $isAlreadyClient->bindValue('email', $lastClient['email'], \PDO::PARAM_STR);
        $isAlreadyClient->execute();


        if ($isAlreadyClient->fetchColumn() > 0) {
            $query =  'update client set prenom = :prenom, nom = :nom, telephone = :telephone, 
            adresse_livraison = :adresse_livraison, adresse_facturation = :adresse_facturation where email= :email';
            $statement = $this->pdo->prepare($query);
            $statement->bindValue('prenom', $lastClient['prenom'], \PDO::PARAM_STR);
            $statement->bindValue('nom', $lastClient['nom'], \PDO::PARAM_STR);
            $statement->bindValue('email', $lastClient['email'], \PDO::PARAM_STR);
            $statement->bindValue('telephone', $lastClient['telephone'], \PDO::PARAM_STR);
            $statement->bindValue('adresse_livraison', $lastClient['adresse_livraison'], \PDO::PARAM_STR);
            $statement->bindValue('adresse_facturation', $lastClient['adresse_facturation'], \PDO::PARAM_STR);
            $statement->execute();
        } else {
            $query = 'insert into ' . self::CLIENT_VALUE_QUERY;
            $statement = $this->pdo->prepare($query);
            $statement->bindValue('prenom', $lastClient['prenom'], \PDO::PARAM_STR);
            $statement->bindValue('nom', $lastClient['nom'], \PDO::PARAM_STR);
            $statement->bindValue('email', $lastClient['email'], \PDO::PARAM_STR);
            $statement->bindValue('telephone', $lastClient['telephone'], \PDO::PARAM_STR);
            $statement->bindValue('adresse_livraison', $lastClient['adresse_livraison'], \PDO::PARAM_STR);
            $statement->bindValue('adresse_facturation', $lastClient['adresse_facturation'], \PDO::PARAM_STR);
            $statement->execute();
        }
    }


    public function getLastClientID(string $email)
    {
        $query = 'select idclient from client where email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['idclient'];
    }
    public function getLastClientInfos(string $email)
    {
        $query = 'select * from client where email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['idclient'];
    }

    public function getLastnumCommande()
    {
        $query = 'SELECT MAX(numeroCommande) AS maxNumeroCommande FROM devis';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['maxNumeroCommande'];
    }

    public function getDateAndConvive()
    {
        $query = 'SELECT nbconvives, date from devis where numeroCommande= :numeroCommande';
        $statement = $this->pdo->prepare($query);
        $numeroCommande = $this->getLastnumCommande();
        $statement->bindValue('numeroCommande', $numeroCommande);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function registerDevis(array $orderedProducts, array $client)
    {


        $numCommande = $this->getLastnumCommande();
        $numCommande += 1;
        $idclient = $this->getLastClientID($client['email']);


        foreach ($orderedProducts as $product) {
            $prixTotal = $_SESSION['prixTotal'];

            if ($product[1] > 0) {
                $query = 'INSERT INTO devis (numeroCommande, produit, quantité, prix,
                 nbconvives, date,
                  client_idclient,prixTotal)
            VALUES (:numeroCommande, :produit, :quantite, :prix,
             :nbconvives, :date, 
            :idclient, :prixTotal )';
                $statement = $this->pdo->prepare($query);
                $statement->bindValue('produit', $product[0]);
                $statement->bindValue('quantite', $product[1]);
                $statement->bindValue('prix', $product[2]);
                $statement->bindValue('nbconvives', $client['nbconvives']);
                $statement->bindValue('date', $client['date']);
                $statement->bindValue('numeroCommande', $numCommande);
                $statement->bindValue('idclient', $idclient);
                $statement->bindValue('prixTotal', $prixTotal);
                $statement->execute();
            }
        }
    }


    public function registerAll($email)
    {
        $query = 'insert into commandecontrolleur (client_idclient,numeroCommande) 
        values (:client_id, :numeroCommande)';
        $statement = $this->pdo->prepare($query);
        $clientID = $this->getLastClientID($email);
        $devisID = $this->getLastnumCommande();
        $statement->bindValue('client_id', $clientID);
        $statement->bindValue('numeroCommande', $devisID);
        $statement->execute();
    }

    public function getAllDevis()
    {
        $query = 'select * from commandecontrolleur';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
