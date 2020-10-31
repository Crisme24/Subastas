<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Docrine\Common\Collections\ArrayCollection;
use Docrine\Common\Collection;

/**
 * Sales
 *
 * @ORM\Table(name="sales", indexes={@ORM\Index(name="fk_sales_users", columns={"user_id"}), @ORM\Index(name="fk_sales_products", columns={"product_id"})})
 * @ORM\Entity
 */
class Sale
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
     * @ORM\Column(name="min_price", type="decimal", precision=20, scale=2, nullable=false)
     */
    private $minPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="max_price", type="decimal", precision=20, scale=2, nullable=false)
     */
    private $maxPrice;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $startDate = 'current_timestamp()';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $endDate = 'current_timestamp()';

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $status = 'NULL';

    /**
     * @var \Products
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="sale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bidding", mappedBy="sale")
    */
    private $bidding;

    public function __construct()
    {
        $this->bidding = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPrice(): ?string
    {
        return $this->minPrice;
    }

    public function setMinPrice(string $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?string
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(string $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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

    /**
     * @return Collection|Bidding[]
    */
    public function getBiddings(): Collection
    {
        return $this->bidding;
    }

}
