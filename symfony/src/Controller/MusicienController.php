<?php

namespace App\Controller;

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
            ->findBy([],null,50);

        return $this->render('musicien/index.html.twig', ['musiciens' => $musiciens]);
    }

    /**
     * @Route("/new", name="musicien_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $musicien = new Musicien();
        $form = $this->createForm(MusicienType::class, $musicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($musicien);
            $entityManager->flush();

            return $this->redirectToRoute('musicien_index');
        }

        return $this->render('musicien/new.html.twig', [
            'musicien' => $musicien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{codeMusicien}", name="musicien_show", methods={"GET"})
     */
    public function show(Musicien $musicien): Response
    {

        $listeOeuvre = $this->getDoctrine->getRepository(Composer::class)->findOeuvre($musicien);
        return $this->render('musicien/show.html.twig', 
                            ['musicien' => $musicien],
                            ['musicien' => $listeOeuvre]);
    }

    /**
     * @Route("/{codeMusicien}/edit", name="musicien_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Musicien $musicien): Response
    {
        $form = $this->createForm(MusicienType::class, $musicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('musicien_index', ['codeMusicien' => $musicien->getCodeMusicien()]);
        }

        return $this->render('musicien/edit.html.twig', [
            'musicien' => $musicien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{codeMusicien}", name="musicien_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Musicien $musicien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musicien->getCodeMusicien(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($musicien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('musicien_index');
    }
}
