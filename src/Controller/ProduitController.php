<?php

namespace App\Controller;

use App\Model\ProduitModel;
use App\Service\GetProduitById;

class ProduitController extends AbstractController
{
    public function add(): string
    {
        $this->checkLoginStatus();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produits = array_map('trim', $_POST);
            $adminModel = new ProduitModel();
            $adminModel->addProduit($produits);
            header('Location: show');
        } else {
            return $this->twig->render('Produit/add.html.twig');
        }
        return $this->twig->render('Produit/add.html.twig');
    }

    public function show(): string
    {
        $this->checkLoginStatus();
        $adminModel = new ProduitModel();
        $produits = $adminModel->selectProduitForNextWeeks();

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $adminModel->deleteProduit($_GET['id']);
            header('Location: show');
        }
        return $this->twig->render('Produit/show.html.twig', [
            'produits' => $produits
        ]);
    }

    public function update($id): string
    {
        $this->checkLoginStatus();
        $id = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        if (false == $id || null == $id) {
            header("Location: show");
        }

        $model = new GetProduitById();
        $produits = $model->getProduitById($id);

        if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ProduitModel();
            $model->updateProduitById($_GET['id']);
            header('Location: show');
        }
        return $this->twig->render('Produit/update.html.twig', [
            'produits' => $produits,
        ]);
    }

    public function showByWeek(): string
    {
        $this->checkLoginStatus();
        $adminModel = new ProduitModel();
        $produitbyweek = null;
        $weeks = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $semaine = $_POST['semaine'];
            $annee = $_POST['annee'];
            $_SESSION['semaine'] = $semaine;
            $_SESSION['annee'] = $annee;
            $produitbyweek = $adminModel->selectProduitByWeek($semaine, $annee);
            $weeks = $adminModel->getDatebyWeek($semaine, $annee);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $adminModel->deleteProduit($_GET['id']);
        }

        $produits = $adminModel->selectProduitForNextWeeks();

        return $this->twig->render('Produit/show-by-week.html.twig', [
            'produitbyweek' => $produitbyweek,
            'semaine' => $semaine ?? null,
            'annee' => $annee ?? null,
            'weeks' => $weeks ?? null,
            'produits' => $produits
        ]);
    }
}
