<?php

namespace App\Model;

use App\Model\AbstractManager;
use DateTime;

class ProduitModel extends AbstractManager
{
    public function addProduit(array $produits): void
    {
        $query = 'INSERT INTO produit (annee, semaine, nom, description, menu, regime, prix) 
            VALUES (:annee, :semaine, :nom, :description, :menu, :regime, :prix)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('annee', $produits['annee'], \PDO::PARAM_INT);
        $statement->bindValue('semaine', $produits['semaine'], \PDO::PARAM_INT);
        $statement->bindValue('nom', $produits['nom'], \PDO::PARAM_STR);
        $statement->bindValue('description', $produits['description'], \PDO::PARAM_STR);
        $statement->bindValue('menu', $produits['menu'], \PDO::PARAM_STR);
        $statement->bindValue('regime', $produits['regime'], \PDO::PARAM_STR);
        $statement->bindValue('prix', $produits['prix'], \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteProduit($id): void
    {
        $query = 'DELETE FROM produit WHERE idproduit = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function updateProduitById($id): void
    {
        $query = 'UPDATE produit SET annee = :annee, semaine = :semaine, nom = :nom, description = :description, 
        menu = :menu, regime = :regime, prix = :prix WHERE idproduit = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('annee', $_POST['annee'], \PDO::PARAM_INT);
        $statement->bindValue('semaine', $_POST['semaine'], \PDO::PARAM_INT);
        $statement->bindValue('nom', $_POST['nom'], \PDO::PARAM_STR);
        $statement->bindValue('description', $_POST['description'], \PDO::PARAM_STR);
        $statement->bindValue('menu', $_POST['menu'], \PDO::PARAM_STR);
        $statement->bindValue('regime', $_POST['regime'], \PDO::PARAM_STR);
        $statement->bindValue('prix', $_POST['prix'], \PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectProduitForNextWeeks(): array
    {
        $date = new DateTime();
        $semaine = (int) $date->format("W");
        $annee = (int) $date->format("Y");
        $produits = array();
        for ($i = 0; $i < 10; $i++) {
            $query = 'SELECT * FROM produit 
            WHERE semaine = :semaine AND annee = :annee
            ORDER BY semaine ASC';
            $statement = $this->pdo->prepare($query);
            $statement->bindValue('semaine', $semaine, \PDO::PARAM_INT);
            $statement->bindValue('annee', $annee, \PDO::PARAM_INT);
            $statement->execute();
            $produits = array_merge($produits, $statement->fetchAll());
            $semaine++;
        }
        return $produits;
    }

    public function selectProduitByWeek($semaine, $annee): array
    {
        $query = 'SELECT * FROM produit WHERE semaine = :semaine AND annee = :annee';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('semaine', $semaine, \PDO::PARAM_STR);
        $statement->bindValue('annee', $annee, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getDatebyWeek($semaine, $annee): array
    {
        $dto = new DateTime();
        $dto->setISODate($annee, $semaine);
        $year = $dto->format('Y');
        $start = $dto->modify('monday this week')->format('d-m-Y');
        $end = $dto->modify('sunday this week')->format('d-m-Y');
        return array('debut' => $start, 'fin' => $end, 'annee' => $year, 'semaine' => $semaine);
    }
}
