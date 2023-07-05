<?php

namespace App\Controller;

use App\Model\UserManager;

class LoginController extends AbstractController
{
    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $userManager = new UserManager();
            $user = $userManager->selectOneByUsername($credentials['username']);

            if ($user && password_verify($credentials['password'], $user['password'])) {
                $_SESSION['isLogin'] = true;
                header('Location: /admin');
                exit();
            } else {
                $errors[] = 'Wrong username or password';
            }
        }
        return $this->twig->render('Login/login.html.twig', ['errors' => $errors]);
    }
}
