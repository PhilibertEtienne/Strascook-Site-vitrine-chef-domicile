<?php

namespace App\Controller;

use App\Model\ClientModel;
use App\Model\Connection;
use PDO;

class CommandeValideeAdminController extends AbstractController
{
    public function browse()
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
    }
}
