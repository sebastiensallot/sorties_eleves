<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sortie", inversedBy="sorties")
     */
    private $sorties_lieux;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sortie", inversedBy="sorties")
     */
    private $lieu_villes;








    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortiesLieux()
    {
        return $this->sorties_lieux;
    }

    /**
     * @param mixed $sorties_lieux
     */
    public function setSortiesLieux($sorties_lieux): void
    {
        $this->sorties_lieux = $sorties_lieux;
    }

    /**
     * @return mixed
     */
    public function getLieuVilles()
    {
        return $this->lieu_villes;
    }

    /**
     * @param mixed $lieu_villes
     */
    public function setLieuVilles($lieu_villes): void
    {
        $this->lieu_villes = $lieu_villes;
    }


}
