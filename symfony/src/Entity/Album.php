<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="Album", indexes={@ORM\Index(name="IDX_F8594147E1990660", columns={"Code_Genre"}), @ORM\Index(name="IDX_F8594147EA8CE117", columns={"Code_Editeur"})})
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Album", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeAlbum;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Album", type="string", length=400, nullable=false)
     */
    private $titreAlbum;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Annee_Album", type="integer", nullable=true)
     */
    private $anneeAlbum;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="Pochette", type="binary", nullable=true)
     */
    private $pochette;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ASIN", type="string", length=20, nullable=true)
     */
    private $asin;

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
     * @var \Editeur
     *
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Editeur", referencedColumnName="Code_Editeur")
     * })
     */
    private $codeEditeur;

    public function getCodeAlbum(): ?int
    {
        return $this->codeAlbum;
    }

    public function getTitreAlbum(): ?string
    {
        return $this->titreAlbum;
    }

    public function setTitreAlbum(string $titreAlbum): self
    {
        $this->titreAlbum = $titreAlbum;

        return $this;
    }

    public function getAnneeAlbum(): ?int
    {
        return $this->anneeAlbum;
    }

    public function setAnneeAlbum(?int $anneeAlbum): self
    {
        $this->anneeAlbum = $anneeAlbum;

        return $this;
    }

    public function getPochette()
    {
        return $this->pochette;
    }

    public function setPochette($pochette): self
    {
        $this->pochette = $pochette;

        return $this;
    }

    public function getAsin(): ?string
    {
        return $this->asin;
    }

    public function setAsin(?string $asin): self
    {
        $this->asin = $asin;

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

    public function getCodeEditeur(): ?Editeur
    {
        return $this->codeEditeur;
    }

    public function setCodeEditeur(?Editeur $codeEditeur): self
    {
        $this->codeEditeur = $codeEditeur;

        return $this;
    }
    public function getBase64Pochette(): ?string
    {
        $string = stream_get_contents($this->pochette);
        return (base64_encode($string));
    }

}
