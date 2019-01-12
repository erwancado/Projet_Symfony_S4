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
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->findOneBy(['codeAbonne'=>'15480']);
        $enregistrements = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findPanierByAbonne($abonne);
        $prixTotal = 0;
        foreach ($enregistrements as $e)
            $prixTotal+=$e->getPrix();
        return $this->render('/panier/index.html.twig', [
            'enregistrements' => $enregistrements,'prixTotal'=>$prixTotal,
            'historique'=>'false'
        ]);
    }

    /**
     * @Route("/historique", name="historique_achats", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function historique()
    {
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->findOneBy(['codeAbonne'=>'15480']);
        $enregistrements = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findAchatsByAbonne($abonne);
        $prixTotal = 0;
        foreach ($enregistrements as $e)
            $prixTotal+=$e->getPrix();
        return $this->render('/panier/index.html.twig', [
            'enregistrements' => $enregistrements,'prixTotal'=>$prixTotal,
            'historique'=>'true'
        ]);
    }

    /**
     * @Route("/panier", name="ajout-panier-album", methods={"GET"})
     * @param Album $album
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_album(Album $album)
    {
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->findOneBy(['codeAbonne'=>'15480']);
        $enregistrements = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findEnregistrements($album);
        foreach ($enregistrements as $e){
            $this->getDoctrine()
                ->getRepository(Achat::class)
                ->addEnregistrement($abonne,$e);
        }
        return $this->render('/index.html.twig', [
            'enregistrements' => $enregistrements,
        ]);
    }

    /**
     * @Route("/panier", name="ajout-panier-enregistrement", methods={"GET"})
     * @param Enregistrement $enregistrement
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_enregistrement(Enregistrement $enregistrement)
    {
        $abonne = $this->getDoctrine()
            ->getRepository(Abonne::class)
            ->findOneBy(['codeAbonne'=>'15558']);


        $em=$this->getDoctrine()->getManager();
        $achat = new Achat();
        $achat->setAchatConfirme(false);
        $achat->setCodeAbonne($abonne);
        $achat->setCodeEnregistrement($enregistrement);
        $em->persist($achat);
        $em->flush();


        $enregistrements = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findAchatsByAbonne($abonne);
        return $this->render('/index.html.twig', [
            'enregistrements' => $enregistrements,
        ]);
    }
}
