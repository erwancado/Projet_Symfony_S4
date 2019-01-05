<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *
 * @ORM\Table(name="Composition")
 * @ORM\Entity
 */
class Composition
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Composition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeComposition;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Composition", type="string", length=0, nullable=false)
     */
    private $titreComposition;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Annee", type="integer", nullable=true)
     */
    private $annee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Composante_Composition", type="string", length=0, nullable=true)
     */
    private $composanteComposition;

    public function getCodeComposition(): ?int
    {
        return $this->codeComposition;
    }

    public function getTitreComposition(): ?string
    {
        return $this->titreComposition;
    }

    public function setTitreComposition(string $titreComposition): self
    {
        $this->titreComposition = $titreComposition;

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

    public function getComposanteComposition(): ?string
    {
        return $this->composanteComposition;
    }

    public function setComposanteComposition(?string $composanteComposition): self
    {
        $this->composanteComposition = $composanteComposition;

        return $this;
    }


}
