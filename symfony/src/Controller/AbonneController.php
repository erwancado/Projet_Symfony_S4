<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Form\AbonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/abonne")
 */
class AbonneController extends AbstractController
{
    /**
     * @Route("/new", name="abonne_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $abonne = new Abonne();
        $form = $this->createForm(AbonneType::class, $abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crypted = $passwordEncoder->encodePassword($abonne, $abonne->getPassword());
            $abonne->setPassword($crypted);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonne);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('abonne/new.html.twig', [
            'title' => "Inscription",
            'abonne' => $abonne,
            'form' => $form->createView(),
        ]);
    }


}
