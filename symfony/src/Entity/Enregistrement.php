<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enregistrement
 *
 * @ORM\Table(name="Enregistrement")
 * @ORM\Entity
 */
class Enregistrement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Morceau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeMorceau;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=0, nullable=false)
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="Code_Composition", type="integer", nullable=false)
     */
    private $codeComposition;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_de_Fichier", type="string", length=0, nullable=false)
     */
    private $nomDeFichier;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Duree", type="string", length=10, nullable=true, options={"fixed"=true})
     */
    private $duree;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Duree_Seconde", type="integer", nullable=true)
     */
    private $dureeSeconde;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="Extrait", type="binary", nullable=true)
     */
    private $extrait;

    public function getCodeMorceau(): ?int
    {
        return $this->codeMorceau;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCodeComposition(): ?int
    {
        return $this->codeComposition;
    }

    public function setCodeComposition(int $codeComposition): self
    {
        $this->codeComposition = $codeComposition;

        return $this;
    }

    public function getNomDeFichier(): ?string
    {
        return $this->nomDeFichier;
    }

    public function setNomDeFichier(string $nomDeFichier): self
    {
        $this->nomDeFichier = $nomDeFichier;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDureeSeconde(): ?int
    {
        return $this->dureeSeconde;
    }

    public function setDureeSeconde(?int $dureeSeconde): self
    {
        $this->dureeSeconde = $dureeSeconde;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getExtrait()
    {
        return $this->extrait;
    }

    public function setExtrait($extrait): self
    {
        $this->extrait = $extrait;

        return $this;
    }

    public function getBase64Extrait(): ?string
    {
        if ($this->extrait != null){
            $string = stream_get_contents($this->extrait);
            return (base64_encode($string));
        }
        return "Extrait indisponible";
    }

}
