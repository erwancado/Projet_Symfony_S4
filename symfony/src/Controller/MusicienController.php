<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Entity\Musicien;
use App\Form\MusicienType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/musicien")
 */
class MusicienController extends AbstractController
{
    /**
     * @Route("/", name="musicien_index", methods={"GET"})
     */
    public function index(): Response
    {
        $musiciens = $this->getDoctrine()
            ->getRepository(Musicien::class)
            ->findAll();

        return $this->render('musicien/index.html.twig', ['musiciens' => $musiciens]);
    }

    /**
     * @Route("/{codeMusicien}", name="musicien_show", methods={"GET"})
     */
    public function show(Musicien $musicien): Response
    {

        $listeOeuvre = $this->getDoctrine()
            ->getRepository(Composer::class)
            ->findBy(array('codeMusicien'=>$musicien),null,25);
        return $this->render('musicien/show.html.twig', 
                            ['musicien' => $musicien,'oeuvres' => $listeOeuvre]);
    }


}
