<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestres
 *
 * @ORM\Table(name="Orchestres")
 * @ORM\Entity
 */
class Orchestres
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Orchestre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeOrchestre;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Orchestre", type="string", length=150, nullable=false)
     */
    private $nomOrchestre;

    public function getCodeOrchestre(): ?int
    {
        return $this->codeOrchestre;
    }

    public function getNomOrchestre(): ?string
    {
        return $this->nomOrchestre;
    }

    public function setNomOrchestre(string $nomOrchestre): self
    {
        $this->nomOrchestre = $nomOrchestre;

        return $this;
    }


}
