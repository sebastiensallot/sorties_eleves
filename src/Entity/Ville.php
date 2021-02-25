<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
     * @Assert\Length(max=5, maxMessage="5 chiffres maximum !")
     * @ORM\Column(type="string", length=5)
     */
    private $codePostal;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lieu", mappedBy="ville_lieux")
     */
    private $lieux_ville;






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

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLieuxVille()
    {
        return $this->lieux_ville;
    }

    /**
     * @param mixed $lieux_ville
     */
    public function setLieuxVille($lieux_ville): void
    {
        $this->lieux_ville = $lieux_ville;
    }


}
