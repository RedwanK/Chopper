<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends abstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index() {
        return $this->render("Home/index.html.twig");
    }
}
