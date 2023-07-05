<?php

namespace App\Controller;

class MentionsLegalesController extends AbstractController
{
    public function browse(): string
    {
        return $this->twig->render('MentionsLegales/mentions_legales.html.twig');
    }
}
