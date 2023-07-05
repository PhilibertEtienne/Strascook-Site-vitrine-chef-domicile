<?php

namespace App\Controller;

use App\Model\MenuModel;
use App\Tools;

class MenuController extends AbstractController
{
    public function browse()
    {
        $menumodel = new MenuModel();

            $entree = $menumodel->displayTypeOfProduitsPerWeekandRegime('entree', CURRENT_WEEK, null);
            $plat = $menumodel->displayTypeOfProduitsPerWeekandRegime('plat', CURRENT_WEEK, null);
            $dessert = $menumodel->displayTypeOfProduitsPerWeekandRegime('dessert', CURRENT_WEEK, null);
            $boisson = $menumodel->displayBoisson();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['week']) && ($_POST['week']) == 'currentWeek') {
                $_POST['week'] = CURRENT_WEEK;
            } elseif (isset($_POST['week']) && ($_POST['week']) == 'nextWeek') {
                $_POST['week'] = NEXT_WEEK;
            } else {
                $_POST['week'] = CURRENT_WEEK;
            }

            $entree = $menumodel->displayTypeOfProduitsPerWeekandRegime(
                'entree',
                $_POST['week'],
                $_POST['regime'] ?? null
            );
            $plat = $menumodel->displayTypeOfProduitsPerWeekandRegime(
                'plat',
                $_POST['week'],
                $_POST['regime'] ?? null
            );
            $dessert = $menumodel->displayTypeOfProduitsPerWeekandRegime(
                'dessert',
                $_POST['week'],
                null
            );
            $_SESSION = $_POST;
        }
        return $this->twig->render('Menu/menu.html.twig', [
            'entree' => $entree,
            'plat' => $plat,
            'dessert' => $dessert,
            'boissons' => $boisson])
        ;
    }
}
