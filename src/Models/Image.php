<?php
namespace Up\Models;
class Image
{
    private ?int $id;
    private ?int $productId;
    private ?string $path;
    private ?int $isCover;

    /**
     * @param int|null $id
     * @param int|null $productId
     * @param string $path
     * @param int $isCover
     */
    public function __construct(?int $id, ?int $productId, ?string $path, ?int $isCover)
    {
        $this->id = $id ?? null;
        $this->productId = $productId ?? null;
        $this->path = $path ?? null;
        $this->isCover = $isCover ?? null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getIsCover(): int
    {
        return $this->isCover;
    }

    public function setIsCover(int $isCover): void
    {
        $this->isCover = $isCover;
    }

}
