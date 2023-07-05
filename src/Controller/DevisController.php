<?php

namespace App\Controller;

use App\Model\ClientModel;
use App\Model\Connection;
use App\Model\DevisModel;
use PDO;

class DevisController extends AbstractController
{
    public function browse(): string
    {
        $devisModel = new DevisModel();
        $devis = $devisModel->getDevisAndClientWithValidatedorNotAndNumCommande(null, null);
        $this->checkLoginStatus();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!isset($_POST['validate']))) {
            $devis = $devisModel->getDevisAndClientWithValidatedorNotAndNumCommande(
                $_POST['validated'],
                $_POST['idCommande']
            );
        }
        if (isset($_POST['validate'])) {
            $buttonValue = $_POST['validate'];
            list($numeroCommande, $action) = explode('|', $buttonValue);
            if ($action === "refuser") {
                $devisModel->unValidateDevis($numeroCommande);
                $devis = $devisModel->getDevisAndClientWithValidatedorNotAndNumCommande(null, null);
            }
            if ($action === "supprimer") {
                $devisModel->DeleteDevis($numeroCommande);
                $devis = $devisModel->getDevisAndClientWithValidatedorNotAndNumCommande(null, null);
            }
            if ($action === "valider") {
                $devisModel->validateDevis($numeroCommande);
                $devis = $devisModel->getDevisAndClientWithValidatedorNotAndNumCommande(null, null);
            }

            if (isset($_POST['idCommande'])) {
                $_POST['validated'] = '';
            }
        }

        return $this->twig->render('Devis/devis.html.twig', [
            'devis' => $devis,
            ]);
    }
}
