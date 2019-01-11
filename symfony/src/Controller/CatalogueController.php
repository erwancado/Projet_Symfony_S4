<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\Musicien;
use App\Entity\Oeuvre;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @Route("/catalogue")
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="albums_index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request):Response
    {
        $search = NULL;
        $formulaire = $this->createFormBuilder()
            ->add('search', SearchType::class, array('constraints' => new Length(array('min' => 3)), 'attr' => array('placeholder' => 'Rechercher un produit')))
            ->add('send', SubmitType::class, array('label' => 'Rechercher'))
            ->getForm();

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $search = $request->get('form')['search'];
            $albums = $this->getDoctrine()
                ->getRepository(Album::class)
                ->findAlbumsResearch($search);

        } else {
            $albums = $this->getDoctrine()
                ->getRepository(Album::class)
                ->findAll();
        }

        return $this->render('catalogue/index.html.twig', [
            'albums' => $albums,
            'formulaire' => $formulaire -> createView()
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
