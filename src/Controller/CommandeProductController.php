<?php

namespace App\Controller;

use App\Model\CommandesModel;

class CommandeProductController extends AbstractController
{
    public function browse(): string
    {
        $commandeProduits = [];
        $prixTotal = [];
        $count = count($_POST['plat']);
        for ($i = 0; $i < $count; $i++) {
            $produit = $_POST['plat'][$i];
            $quantite = $_POST['commande'][$i];
            $prix = $_POST['prix'][$i];
            $prixTotal[] = $_POST['prix'][$i] * $_POST['commande'][$i];
            $commandeProduits[] = [$produit, $quantite, $prix];
        }

            $prixTotal = array_sum($prixTotal);
            $_SESSION['prixTotal'] = $prixTotal;
            $_SESSION['commandeProduits'] = $commandeProduits;
        return $this->twig->render(
            'CommandeProduit/CommandeProduit.html.twig',
            ['commandeProduits' => $commandeProduits,'prixTotal' => $prixTotal]
        );
    }
}
