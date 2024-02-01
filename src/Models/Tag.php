<?php

namespace Up\Models;

class Tag
{
	private ?int $id;
	private ?string $title;
	private ?int $entityStatusId;

	/**
	 * @param int|null $id
	 * @param string|null $title
	 * @param int|null $entityStatusId
	 */
	public function __construct(?int $id, ?string $title, ?int $entityStatusId)
	{
		$this->id = $id ?? null;
		$this->title = $title ?? null;
		$this->entityStatusId = $entityStatusId ?? null;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(?string $title): void
	{
		$this->title = $title;
	}

	public function getEntityStatusId(): ?int
	{
		return $this->entityStatusId;
	}

	public function setEntityStatusId(?int $entityStatusId): void
	{
		$this->entityStatusId = $entityStatusId;
	}
}