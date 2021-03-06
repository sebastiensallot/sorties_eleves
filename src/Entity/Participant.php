<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 * @UniqueEntity(fields={"pseudo"})
 * @UniqueEntity(fields={"email"})
 */
class Participant implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=255)
     * @Assert\Length(min = 3, minMessage = "Le pseudo doit contenir {{limit}} caractère minimum",
     *     allowEmptyString=false)

     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min = 3, minMessage = "Le nom doit contenir {{limit}} caractère minimum",
     *     allowEmptyString=false)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", length=10)
     * @
     */
    private $telephone;

    /**
     * @ORM\Column(name="email",type="string", length=255)
     * @Assert\Email( message="Le format de l'email est incorrect")
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $actif;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = ["ROLE_USER"];


    /**
     * @ORM\ManyToMany (targetEntity="App\Entity\Sortie", mappedBy="participants")
     */
    private $sorties;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="campus")
     */
    private $participants_campus;



    //getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }



    public function getPassword()
    {
        return $this->motDePasse;
    }

    public function getSalt()
    {
        return null;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->pseudo;
    }

    public function eraseCredentials() {}

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
       return $this->roles;
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }


    /**
     * @return ArrayCollection
     */
    public function getSorties(): ArrayCollection
    {
        return $this->sorties;
    }

    /**
     * @param ArrayCollection $sorties
     */
    public function setSorties(ArrayCollection $sorties): void
    {
        $this->sorties = $sorties;
    }

    /**
     * @return mixed
     */
    public function getParticipantsCampus()
    {
        return $this->participants_campus;
    }

    /**
     * @param mixed $participants_campus
     */
    public function setParticipantsCampus($participants_campus): void
    {
        $this->participants_campus = $participants_campus;
    }




}
