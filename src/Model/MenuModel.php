<?php

namespace App\Model;

use PDO;

class MenuModel extends AbstractManager
{
    private const SELECT_PRODUIT_QUERY = 'SELECT annee, semaine, nom, description, menu, regime, prix FROM produit';

    public function displayTypeOfProduitsPerWeekandRegime(
        string $menu,
        string $time = 'WEEK(NOW())',
        null|array|string $nature = null
    ) {
        $regime = [];
        $regimeStatement = '';
        if (is_array($nature)) {
            foreach ($nature as $choice) {
                $regime[] = "and regime = '$choice'";
            }
            $regimeStatement = implode(" ", $regime);
        } elseif (is_string($nature)) {
            $regimeStatement = "and regime = '$nature'";
        }

        $query = self::SELECT_PRODUIT_QUERY . ' WHERE semaine = ' . "$time" .
            ' AND menu = :menu AND annee = YEAR(NOW())' . "$regimeStatement";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':menu', $menu, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayBoisson()
    {
        $query = self::SELECT_PRODUIT_QUERY . " WHERE menu = 'boisson' AND annee = YEAR(NOW())";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
