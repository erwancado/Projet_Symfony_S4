<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Entity\Achat;
use App\Entity\Album;
use App\Entity\Enregistrement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class Controller extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
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

    public function nameUser()
    {
        return $this->getUser();
    }


}
