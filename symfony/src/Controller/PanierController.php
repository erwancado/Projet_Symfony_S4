<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Entity\Achat;
use App\Entity\Album;
use App\Entity\Enregistrement as EnregistrementAlias;
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
        if(!$this->getUser()){
            return $this->redirect('/login');
        }
        $abonne = $this->getUser();
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
        if(!$this->getUser()){
            return $this->redirect('/login');
        }
        $abonne = $abonne = $this->getUser();
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
     * @Route("/panier/ajout_panier_album/{codeAlbum}", name="ajout-panier-album", methods={"GET"})
     * @param int $codeAlbum
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_album(int $codeAlbum)
    {
        if(!$this->getUser()){
            return $this->redirect('/login');
        }
        $album=$this->getDoctrine()
            ->getRepository(Album::class)
            ->find($codeAlbum);
        $abonne = $this->getUser();
        $enregistrements = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findEnregistrements($album);
        foreach ($enregistrements as $e){
            $em=$this->getDoctrine()->getManager();
            $achat = new Achat();
            $achat->setAchatConfirme(false);
            $achat->setCodeAbonne($abonne);
            $achat->setCodeEnregistrement($e);
            $em->persist($achat);
            $em->flush();
        }
        return $this->redirect('/panier');
    }

    /**
     * @Route("/panier/ajout_panier_enregistrement/{codeEnregistrement}", name="ajout-panier-enregistrement", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajout_panier_enregistrement(int $codeEnregistrement)
    {
        $abonne = $this->getUser();

        $enregistrement=$this->getDoctrine()
            ->getRepository(Enregistrement::class)
            ->find($codeEnregistrement);
        $em=$this->getDoctrine()->getManager();
        $achat = new Achat();
        $achat->setAchatConfirme(false);
        $achat->setCodeAbonne($abonne);
        $achat->setCodeEnregistrement($enregistrement);
        $em->persist($achat);
        $em->flush();
        return $this->redirect('/panier');
    }

    /**
     * @Route("/panier/suppression_panier_enregistrement/{codeEnregistrement}", name="suppression_panier_enregistrement", methods={"GET"})
     */
    public function suppression_panier_enregistrement(int $codeEnregistrement){
        $abonne = $this->getUser();
        $achat=$this->getDoctrine()
            ->getRepository(Achat::class)
            ->findOneBy(['codeEnregistrement'=>$codeEnregistrement,'codeAbonne'=>$abonne->getCodeAbonne()]);
        $this->getDoctrine()->getManager()
            ->remove($achat);
        $this->getDoctrine()->getManager()
            ->flush();
        return $this->redirect('/panier');

    }

    /**
     * @Route("/panier/validation_panier", name="validation_panier")
     */
    public function validation_panier(){
        $abonne = $this->getUser();
        $achats = $this->getDoctrine()
            ->getRepository(Achat::class)
            ->findBy(['codeAbonne'=>$abonne->getCodeAbonne()]);
        $em = $this->getDoctrine()->getManager();
        foreach($achats as $achat){
            $achat->setAchatConfirme(true);
            $em->persist($achat);
            $em->flush();
        }
        return $this->redirect('/historique');

    }
}
