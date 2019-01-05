<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="Genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Genre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle_Abrege", type="string", length=60, nullable=false)
     */
    private $libelleAbrege;

    public function getCodeGenre(): ?int
    {
        return $this->codeGenre;
    }

    public function getLibelleAbrege(): ?string
    {
        return $this->libelleAbrege;
    }

    public function setLibelleAbrege(string $libelleAbrege): self
    {
        $this->libelleAbrege = $libelleAbrege;

        return $this;
    }


}
