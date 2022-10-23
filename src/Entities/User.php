<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Persisters\Collection\ManyToManyPersister;
use Doctrine\ORM\Persisters\Collection\OneToManyPersister;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\UserDatabaseRepository")
 * @ORM\Table(name="users")
 */
class User
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

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entities\Task", mappedBy="App\Entities\Task")
//     */
//    private $tasks;

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
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $password
     */
    public function setPasswordHash(string $password): void
    {
        $this->passwordHash = password_hash($password, 1);
    }

//    public function getTasks()
//    {
//        return $this->tasks;
//    }
}