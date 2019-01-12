<?php

namespace App\Controller;

use App\Entity\Abonne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {;
        return $this->render('/index.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }


    /**
     * @Route("/about", name="about")
     */
    public function index_about()
    {
        return $this->render('/about.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function index_panier()
    {
        return $this->render('/panier.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

}
