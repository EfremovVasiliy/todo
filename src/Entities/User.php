<?php

namespace App\Entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Jasny\Auth\ContextInterface as Context;
use Jasny\Auth\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\UserDatabaseRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique="true")
     * @var string
     */
    private string $nickname;

    /**
     * @ORM\Column(type="string", unique="true")
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $passwordHash;

    /**
     * @ORM\OneToMany(targetEntity="App\Entities\Task", mappedBy="user")
     * @var Collection
     */
    private Collection $tasks;

    public function __construct(string $nickname, string $email, string $password)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->passwordHash = password_hash($password, 1);
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function getAuthId(): string
    {
        // TODO: Implement getAuthId() method.
    }

    public function verifyPassword(string $password): bool
    {
        // TODO: Implement verifyPassword() method.
    }

    public function getAuthChecksum(): string
    {
        // TODO: Implement getAuthChecksum() method.
    }

    public function getAuthRole(Context|null $context = null)
    {
        // TODO: Implement getAuthRole() method.
    }

    public function requiresMfa(): bool
    {
        // TODO: Implement requiresMfa() method.
    }
}