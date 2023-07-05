<?php

namespace App\Controller;

use App\Model\ClientModel;
use App\Model\CommandeModel;
use App\Model\Connection;
use PDO;

class CommandeValideeController extends AbstractController
{
    public function browse(): string
    {
        $orderedProducts = [];
        foreach ($_SESSION['commandeProduits'] as $produit) {
            if ($produit[1] > 0) {
                if (array_key_exists($produit[0], $orderedProducts)) {
                    $orderedProducts[$produit[0]]['quantity'] += $produit[1];
                    $orderedProducts[$produit[0]]['price'] += $produit[2] * $produit[1];
                } else {
                    $orderedProducts[$produit[0]] = [
                        'quantity' => $produit[1],
                        'price' => $produit[2] * $produit[1]
                    ];
                }
            }
        }
        $clientModel = new ClientModel();
        $lastClient = $clientModel->selectLastClient();
        $commandeModel = new CommandeModel();
        $dateAndConvives = $commandeModel->getDateAndConvive();
        $prixTotal = $_SESSION['prixTotal'];
          return $this->twig->render(
              'CommandeValidee/commande_validee.html.twig',
              [
              'lastClient' => $lastClient,
              'orderedProducts' => $orderedProducts,
              'dateAndConvives' => $dateAndConvives,
              'prixTotal' => $prixTotal
              ]
          );
    }
}
