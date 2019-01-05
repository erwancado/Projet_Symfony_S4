<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="Pays", uniqueConstraints={@ORM\UniqueConstraint(name="IX_Pays", columns={"Nom_Pays"})})
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="Code_Pays", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codePays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nom_Pays", type="string", length=50, nullable=true)
     */
    private $nomPays;

    public function getCodePays(): ?int
    {
        return $this->codePays;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(?string $nomPays): self
    {
        $this->nomPays = $nomPays;

        return $this;
    }


}
