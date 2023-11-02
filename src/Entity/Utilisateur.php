<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiProperty;


#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource(
    operations: [
    new GetCollection(),
    new Get(),
    new Post(),
    new Put(),
    new Patch(),
    new Delete()
    ],
    order: ["login" => "ASC"]
)]
class Utilisateur implements UserInterface //PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Length(min: 4, minMessage:"Il faut au moins 4 caractères", max: 20 , maxMessage: 'Il ne faut pas dépasser plus de 20 caractères')]
    #[Assert\NotNull(message:"ne doit pas être null")]
    #[Assert\NotBlank(message:"ne doit pas contenir d'espace")]
    private ?string $login = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
//    #[ORM\Column]
//    private ?string $password = null;

    #[ORM\Column(length: 255,unique: true)]
    #[Assert\Email()]
    #[Assert\NotNull(message:"ne doit pas être null")]
    #[Assert\NotBlank(message:"ne doit pas contenir d'espace")]
    private ?string $adresseEmail = null;

//    #[ORM\Column(length: 255, nullable: true)]
//    private ?string $nomPhotoProfil = null;

//    #[ORM\OneToOne(mappedBy: 'auteur', cascade: ['persist', 'remove'])]
//    private ?Publication $publications = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**<div id="flashes-container">
        <!-- Pour chaque message flash d'erreur -->
        {% for flashError in app.flashes('error') %}
            <span class="flashes flashes-error">{{ flashError }}</span>
        {% endfor %}

        <!-- Pour chaque message flash de succès -->
        {% for flashSuccess in app.flashes('success') %}
            <span class="flashes flashes-success">{{ flashSuccess }}</span>
        {% endfor %}
    </div>
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
//    public function getPassword(): string
//    {
//        return $this->password;
//    }
//
//    public function setPassword(string $password): static
//    {
//        $this->password = $password;
//
//        return $this;
//    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAdresseEmail(): ?string
    {
        return $this->adresseEmail;
    }

    public function setAdresseEmail(string $adresseEmail): static
    {
        $this->adresseEmail = $adresseEmail;

        return $this;
    }

//    public function getNomPhotoProfil(): ?string
//    {
//        return $this->nomPhotoProfil;
//    }
//
//    public function setNomPhotoProfil(?string $nomPhotoProfil): static
//    {
//        $this->nomPhotoProfil = $nomPhotoProfil;
//
//        return $this;
//    }

//    public function getPublications(): ?Publication
//    {
//        return $this->publications;
//    }
//
//    public function setPublications(Publication $publications): static
//    {
//        // set the owning side of the relation if necessary
//        if ($publications->getAuteur() !== $this) {
//            $publications->setAuteur($this);
//        }
//
//        $this->publications = $publications;
//
//        return $this;
//    }
}
