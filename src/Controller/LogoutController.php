<?php

namespace App\Controller;

use App\Model\UserManager;

class LogoutController extends AbstractController
{
    public function logout()
    {
            $_SESSION['isLogin'] = false;
            header('Location: /login');
            exit;
    }
}
