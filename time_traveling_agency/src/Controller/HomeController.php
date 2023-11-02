<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name = "homepage")
     */
    public function index()
    {
        return $this->render('index.php');
    }
}
