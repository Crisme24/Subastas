<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Puja
 *
 * @ORM\Table(name="pujas")
 * @ORM\Entity
 */
class Puja
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $subasta_id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @var \Subasta
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Subasta", inversedBy="puja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subasta_id", referencedColumnName="id")
     * })
     */
    private $subasta;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="puja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function __construct(){
        $this->create_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getSubastaId(): ?int
    {
        return $this->subasta_id;
    }

    public function setSubastaId(int $subasta_id): self
    {
        $this->subasta_id = $subasta_id;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getSubasta()
    {
        return $this->subasta;
    }

    public function setSubasta(?Subasta $subasta): self
    {
        $this->subasta = $subasta;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
