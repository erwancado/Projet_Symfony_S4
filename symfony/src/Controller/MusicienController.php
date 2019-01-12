<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Entity\Musicien;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @Route("/musicien")
 */
class MusicienController extends AbstractController
{
    /**
     * @Route("/", name="musicien_index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $search = NULL;
        $formulaire = $this->createFormBuilder()
            ->add('search', SearchType::class, array('constraints' => new Length(array('min' => 3)), 'attr' => array('placeholder' => 'Rechercher un musicien   ')))
            ->add('send', SubmitType::class, array('label' => 'Rechercher'))
            ->getForm();

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $search = $request->get('form')['search'];
            $musiciens = $this->getDoctrine()
                ->getRepository(Musicien::class)
                ->findBy(array('nomMusicien' => $search));

        } else {
            $musiciens = $this->getDoctrine()
                ->getRepository(Musicien::class)
                ->findAll();
        }

        return $this->render('musicien/index.html.twig', ['musiciens' => $musiciens,
            'formulaire' => $formulaire->createView()]);
    }

    /**
     * @Route("/{codeMusicien}", name="musicien_show", methods={"GET"})
     * @param Musicien $musicien
     * @return Response
     */
    public function show( Musicien $musicien): Response
    {

        return $this->render('musicien/show.html.twig',
            ['musicien' => $musicien,
                'oeuvres' => $musicien->getOeuvres()
            ]);
    }


}
