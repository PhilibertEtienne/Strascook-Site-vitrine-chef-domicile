<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class DevisModel extends AbstractManager
{
    private const GETQUERY = 'select * from devis inner join client on devis.client_idclient = client.idclient ' ;
    private const ORDERQUERY = ' order by numeroCommande desc';


    public function getValidatedDevisAndClient(): array
    {
        $query = self::GETQUERY . 'where isValid = 1' . self::ORDERQUERY;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDevisAndClientWithValidatedorNotAndNumCommande(?string $validated, ?string $numeroCommande)
    {
        $validationQuery = '';
        $commandeQuery = '';


        if (!empty($numeroCommande)) {
            $commandeQuery = " where numeroCommande = $numeroCommande";
            $validationQuery = '';
        }
        if (($validated == 'validated') && (empty($numeroCommande))) {
            $validationQuery = ' where isValid = 1';
        }
        if (($validated == 'unvalidated') && (empty($numeroCommande))) {
            $validationQuery = ' where isValid = 0';
        }

        $query = self::GETQUERY . $validationQuery . $commandeQuery . self::ORDERQUERY;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $devis = $statement->fetchAll(PDO::FETCH_ASSOC);
        $groupedDevis = [];
        foreach ($devis as $product) {
            $numeroCommande = $product['numeroCommande'];
            $isValid = $product['isValid'];
            if (!array_key_exists($numeroCommande, $groupedDevis)) {
                $groupedDevis[$numeroCommande] = [
                    'client' => [
                        'nom' => $product['nom'],
                        'prenom' => $product['prenom'],
                        'email' => $product['email'],
                        'telephone' => $product['telephone'],
                        'nbconvives' => $product['nbconvives'],
                        'numeroCommande' => $product['numeroCommande'],
                        'date' => $product['date'],
                    ],
                    'details' => [],
                    'isValid' => $isValid
                ];
            }
            $groupedDevis[$numeroCommande]['details'][] = [
                'produit' => $product['produit'],
                'quantite' => $product['quantité'],
                'prix' => $product['prix'],
            ];
        }


        return $groupedDevis;
    }


    public function getDevisPerNumCommande($numeroCommande)
    {
        $query = self::GETQUERY . 'where numeroCommande = :numeroCommande';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('numeroCommande', $numeroCommande);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteDevis($numeroCommande)
    {
        $query = 'delete from devis where numeroCommande = :numeroCommande';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('numeroCommande', $numeroCommande);
        $statement->execute();
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
