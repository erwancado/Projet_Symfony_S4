<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvre
 *
 * @ORM\Table(name="Oeuvre", indexes={@ORM\Index(name="IDX_32522BC898F61075", columns={"Code_Type"})})
 * @ORM\Entity
 */
class Oeuvre
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Oeuvre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeOeuvre;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Oeuvre", type="string", length=200, nullable=false)
     */
    private $titreOeuvre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Sous_Titre", type="string", length=200, nullable=true)
     */
    private $sousTitre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Tonalite", type="string", length=40, nullable=true)
     */
    private $tonalite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Opus", type="string", length=40, nullable=true)
     */
    private $opus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Numéro_Opus", type="integer", nullable=true)
     */
    private $numéroOpus;

    /**
     * @var \TypeMorceaux
     *
     * @ORM\ManyToOne(targetEntity="TypeMorceaux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Type", referencedColumnName="Code_Type")
     * })
     */
    private $codeType;

    public function getCodeOeuvre(): ?int
    {
        return $this->codeOeuvre;
    }

    public function getTitreOeuvre(): ?string
    {
        return $this->titreOeuvre;
    }

    public function setTitreOeuvre(string $titreOeuvre): self
    {
        $this->titreOeuvre = $titreOeuvre;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(?string $sousTitre): self
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    public function getTonalite(): ?string
    {
        return $this->tonalite;
    }

    public function setTonalite(?string $tonalite): self
    {
        $this->tonalite = $tonalite;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getOpus(): ?string
    {
        return $this->opus;
    }

    public function setOpus(?string $opus): self
    {
        $this->opus = $opus;

        return $this;
    }

    public function getNuméroOpus(): ?int
    {
        return $this->numéroOpus;
    }

    public function setNuméroOpus(?int $numéroOpus): self
    {
        $this->numéroOpus = $numéroOpus;

        return $this;
    }

    public function getCodeType(): ?TypeMorceaux
    {
        return $this->codeType;
    }

    public function setCodeType(?TypeMorceaux $codeType): self
    {
        $this->codeType = $codeType;

        return $this;
    }


}
