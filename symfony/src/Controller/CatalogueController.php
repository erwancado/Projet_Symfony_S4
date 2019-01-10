<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Oeuvre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/catalogue")
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="albums_index", methods={"GET"})
     */
    public function index()
    {
        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findAll();
        return $this->render('catalogue/index.html.twig', [
            'albums' => $albums,
        ]);
    }
    /**
     * @Route("/{codeAlbum}", name="album_show", methods={"GET"})
     */
    public function show(Album $album): Response
    {

    }
}
