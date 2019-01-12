<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Musicien
 *
 * @ORM\Table(name="Musicien", indexes={@ORM\Index(name="IDX_AC6BE67520B77BF2", columns={"Code_Pays"}), @ORM\Index(name="IDX_AC6BE675E1990660", columns={"Code_Genre"}), @ORM\Index(name="IDX_AC6BE675D389A975", columns={"Code_Instrument"})})
 * @ORM\Entity(repositoryClass="App\Repository\MusicienRepository")
 */
class Musicien
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Musicien", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeMusicien;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Musicien", type="string", length=200, nullable=false)
     */
    private $nomMusicien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Prenom_Musicien", type="string", length=50, nullable=true)
     */
    private $prenomMusicien;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Annee_Naissance", type="integer", nullable=true)
     */
    private $anneeNaissance;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Annee_Mort", type="integer", nullable=true)
     */
    private $anneeMort;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="Photo", type="binary", nullable=true)
     */
    private $photo;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Pays", referencedColumnName="Code_Pays")
     * })
     */
    private $codePays;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Genre", referencedColumnName="Code_Genre")
     * })
     */
    private $codeGenre;

    /**
     * @var \Instrument
     *
     * @ORM\ManyToOne(targetEntity="Instrument")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Instrument", referencedColumnName="Code_Instrument")
     * })
     */
    private $codeInstrument;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Oeuvre")
     * @ORM\JoinTable(name="Composer",
     *      joinColumns={@ORM\JoinColumn(name="Code_Musicien", referencedColumnName="Code_Musicien")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Code_Oeuvre", referencedColumnName="Code_Oeuvre")}
     *      )
     */
    private $oeuvres;

    public function getCodeMusicien(): ?int
    {
        return $this->codeMusicien;
    }

    public function getOeuvres()
    {
        return $this->oeuvres;
    }

    public function getNomMusicien(): ?string
    {
        return $this->nomMusicien;
    }

    public function setNomMusicien(string $nomMusicien): self
    {
        $this->nomMusicien = $nomMusicien;

        return $this;
    }

    public function getPrenomMusicien(): ?string
    {
        return $this->prenomMusicien;
    }

    public function setPrenomMusicien(?string $prenomMusicien): self
    {
        $this->prenomMusicien = $prenomMusicien;

        return $this;
    }

    public function getAnneeNaissance(): ?int
    {
        return $this->anneeNaissance;
    }

    public function setAnneeNaissance(?int $anneeNaissance): self
    {
        $this->anneeNaissance = $anneeNaissance;

        return $this;
    }

    public function getAnneeMort(): ?int
    {
        return $this->anneeMort;
    }

    public function setAnneeMort(?int $anneeMort): self
    {
        $this->anneeMort = $anneeMort;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCodePays(): ?Pays
    {
        return $this->codePays;
    }

    public function setCodePays(?Pays $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getCodeGenre(): ?Genre
    {
        return $this->codeGenre;
    }

    public function setCodeGenre(?Genre $codeGenre): self
    {
        $this->codeGenre = $codeGenre;

        return $this;
    }

    public function getCodeInstrument(): ?Instrument
    {
        return $this->codeInstrument;
    }

    public function setCodeInstrument(?Instrument $codeInstrument): self
    {
        $this->codeInstrument = $codeInstrument;

        return $this;
    }

    public function getBase64Photo(): ?string 
    {
        if ($this->photo != null){
            $string = stream_get_contents($this->photo);
            return (base64_encode($string));
        }
       return "Photo indisponible";
    }
}
