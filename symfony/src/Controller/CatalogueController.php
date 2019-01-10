<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\Oeuvre;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/catalogue")
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="albums_index", methods={"GET"})
     */
    public function index():Response
    {
        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findAll();
        return $this->render('catalogue/index.html.twig', [
            'albums' => $albums
        ]);
    }
    /**
     * @Route("/{codeAlbum}", name="album_show", methods={"GET"})
     */
    public function show(Album $album): Response
    {
        $editeur = $this->getDoctrine()
            ->getRepository(Editeur::class)
            ->find($album->getCodeEditeur());
        $genre = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->find($album->getCodeGenre());
        $enregistrements=$this->getDoctrine()
            ->getRepository(Album::class)
            ->findEnregistrements($album);
        return $this->render('catalogue/album.html.twig',['album'=>$album,'editeur'=>$editeur,
            'genre'=>$genre, 'enregistrements'=>$enregistrements]);


    }
}
