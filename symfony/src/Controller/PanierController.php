<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Entity\Achat;
use App\Entity\Album;
use App\Entity\Enregistrement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;


class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="index_panier", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        if(!(isset($_SESSION['login']) && isset($_SESSION['password']))){
           return $this->render('security/login.html.twig');
        }
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->findOneBy(['codeAbonne'=>'15480']);
        $enregistrements = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findAchatsByAbonne($abonne);
        return $this->render('/panier/index.html.twig', [
            'enregistrements' => $enregistrements,
        ]);
    }

    /**
     * @Route("/panier", name="ajout-panier-album", methods={"GET"})
     * @param Abonne $code_abonne
     * @param Album $album
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_album(Abonne $code_abonne,Album $album)
    {
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->find($code_abonne);
        return $this->render('/index.html.twig', [
            'controller_name' => 'Controller',
        ]);
    }

    /**
     * @Route("/panier", name="ajout-panier-enregistrement", methods={"GET"})
     * @param Abonne $code_abonne
     * @param Enregistrement $enregistrement
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_enregistrement(Abonne $code_abonne,Enregistrement $enregistrement)
    {
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->find($code_abonne);
        $this->getDoctrine()
            ->getRepository(Achat::class)
            ->addEnregistrement($abonne,$enregistrement);
        $enregistrements = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findAchatsByAbonne($abonne);
        return $this->render('/index.html.twig', [
            'enregistrements' => $enregistrements,
        ]);
    }
}
