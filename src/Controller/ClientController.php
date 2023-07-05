<?php

namespace App\Controller;

use App\Model\ClientModel;
use App\Service\GetCommandeById;

class ClientController extends AbstractController
{
    public function add(): string
    {
        $this->checkLoginStatus();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client = array_map('trim', $_POST);
            $commandesModel = new ClientModel();
            $commandesModel->addClient($client);
            header('Location: show');
        } else {
            return $this->twig->render('Client/add.html.twig');
        }
        return $this->twig->render('Client/add.html.twig');
    }

    public function show(): string
    {
        $this->checkLoginStatus();
        $commandesModel = new ClientModel();
        $commande = $commandesModel->selectClient();

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id = trim($_GET['id']);
            $clientModel = new ClientModel();
            $clientModel->deleteClient((int)$id);
            header('Location:show');
        }

        return $this->twig->render('Client/show.html.twig', ['commande' => $commande]);
    }

    public function update($id): string
    {
        $this->checkLoginStatus();
        $id = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        if (false == $id || null == $id) {
            header("Location: show");
        }

        $commandesModel = new GetCommandeById();
        $commande = $commandesModel->getCommandeById($id);

        if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ClientModel();
            $model->updateClientById($_GET['id']);
            header('Location: show');
        }
        return $this->twig->render('Client/update.html.twig', [
            'commande' => $commande,
        ]);
    }
}
