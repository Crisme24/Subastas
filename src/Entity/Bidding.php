<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Biddings
 *
 * @ORM\Table(name="biddings", indexes={@ORM\Index(name="fk_biddings_sales", columns={"sale_id"}), @ORM\Index(name="fk_biddings_users", columns={"user_id"})})
 * @ORM\Entity
 */
class Bidding
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="bid", type="decimal", precision=20, scale=2, nullable=false)
     */
    private $bid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $descripcion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $createdAt = 'current_timestamp()';

    /**
     * @var \Sales
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Sale", inversedBy="bidding")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="id")
     * })
     */
    private $sale;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bidding")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBid(): ?string
    {
        return $this->bid;
    }

    public function setBid(string $bid): self
    {
        $this->bid = $bid;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSale()
    {
        return $this->sale;
    }

    public function setSale(?Sale $sale): self
    {
        $this->sale = $sale;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
