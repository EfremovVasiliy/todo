<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\TaskDatabaseRepository")
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length="300")
     * @var string
     */
    private string $title;

    /**
     * @ORM\Column(type="text", length="1000")
     * @var string
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entities\User", inversedBy="tasks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private DateTime $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private DateTime $expires;

    public function __construct(string $title, string $description, DateTime $expires, User $user)
    {
        $this->title = $title;
        $this->description = $description;
        $this->user = $user;
        $this->expires = $expires;
        $this->created_at = new DateTime('now');
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param DateTime $expires
     */
    public function setExpires(DateTime $expires): void
    {
        $this->expires = $expires;
    }
}