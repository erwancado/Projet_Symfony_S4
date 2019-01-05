<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/default", name="")
     */
    public function index()
    {
        return $this->render('/index.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

      /**
     * @Route("/default/{nom}", name="name_default")
     */
    public function hello($nom){
        return $this->render('/name.html.twig', array(
            'nom' => $nom
        )); 
    }
}
