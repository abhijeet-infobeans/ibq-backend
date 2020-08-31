<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GreetingsController extends AbstractController
{
    /**
     * @Route("/greetings", name="greetings")
     */
    public function index()
    {
        return $this->render('greetings/index.html.twig', [
            'controller_name' => 'GreetingsController',
        ]);
    }
}
