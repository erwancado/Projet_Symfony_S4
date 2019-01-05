<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompositionDisque
 *
 * @ORM\Table(name="Composition_Disque", indexes={@ORM\Index(name="IDX_6F414DB4B1A3EE1", columns={"Code_Disque"}), @ORM\Index(name="IDX_6F414DB4D990D4F0", columns={"Code_Morceau"})})
 * @ORM\Entity
 */
class CompositionDisque
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Contenir", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeContenir;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var \Disque
     *
     * @ORM\ManyToOne(targetEntity="Disque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Disque", referencedColumnName="Code_Disque")
     * })
     */
    private $codeDisque;

    /**
     * @var \Enregistrement
     *
     * @ORM\ManyToOne(targetEntity="Enregistrement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Code_Morceau", referencedColumnName="Code_Morceau")
     * })
     */
    private $codeMorceau;

    public function getCodeContenir(): ?int
    {
        return $this->codeContenir;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCodeDisque(): ?Disque
    {
        return $this->codeDisque;
    }

    public function setCodeDisque(?Disque $codeDisque): self
    {
        $this->codeDisque = $codeDisque;

        return $this;
    }

    public function getCodeMorceau(): ?Enregistrement
    {
        return $this->codeMorceau;
    }

    public function setCodeMorceau(?Enregistrement $codeMorceau): self
    {
        $this->codeMorceau = $codeMorceau;

        return $this;
    }


}
