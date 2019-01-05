<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Instrument
 *
 * @ORM\Table(name="Instrument", uniqueConstraints={@ORM\UniqueConstraint(name="IX_Instrument", columns={"Nom_Instrument"})})
 * @ORM\Entity
 */
class Instrument
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Instrument", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeInstrument;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Instrument", type="string", length=50, nullable=false)
     */
    private $nomInstrument;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="Image", type="binary", nullable=true)
     */
    private $image;

    public function getCodeInstrument(): ?int
    {
        return $this->codeInstrument;
    }

    public function getNomInstrument(): ?string
    {
        return $this->nomInstrument;
    }

    public function setNomInstrument(string $nomInstrument): self
    {
        $this->nomInstrument = $nomInstrument;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }


}
