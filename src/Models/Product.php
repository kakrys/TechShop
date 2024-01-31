<?php

namespace Up\Models;

class Product
{
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $brand;


    private ?float $price;
    private ?int $entityStatusId;
    private ?\DateTime $dateRelease;
    private ?\DateTime $dateUpdate;
    private ?int $sortOrder;
    private ?array $tags;
    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param float $price
     * @param int $entityStatusId
     * @param \DateTime $dateRelease
     * @param \DateTime $dateUpdate
     * @param int $sortOrder
     * @param array $tags
     * @param string $brand
     */
    public function __construct(?int $id, ?string $title,
                                ?string $description, ?float $price,
                                ?int $entityStatusId, ?\DateTime $dateRelease,
                                ?\DateTime $dateUpdate, ?int $sortOrder,
                                ?array $tags,?string $brand)
    {
        $this->id = $id??null;
        $this->title = $title??null;
        $this->description = $description??null;
        $this->price = $price??null;
        $this->entityStatusId = $entityStatusId??null;
        $this->dateRelease = $dateRelease??null;
        $this->dateUpdate = $dateUpdate??null;
        $this->sortOrder = $sortOrder??null;
        $this->tags = $tags??[];
        $this->$brand=$brand??null;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getEntityStatusId(): int
    {
        return $this->entityStatusId;
    }

    public function setEntityStatusId(int $entityStatusId): void
    {
        $this->entityStatusId = $entityStatusId;
    }

    public function getDateRelease(): \DateTime
    {
        return $this->dateRelease;
    }

    public function setDateRelease(\DateTime $dateRelease): void
    {
        $this->dateRelease = $dateRelease;
    }

    public function getDateUpdate(): \DateTime
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(\DateTime $dateUpdate): void
    {
        $this->dateUpdate = $dateUpdate;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function addTag(Tag $tag):void
    {
        $this->tags[]=$tag;
    }
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }
}