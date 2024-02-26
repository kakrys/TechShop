<?php

namespace Up\Models;

class Order
{
	readonly int $id;
	readonly string $dataCreate;
	readonly float $price;
	readonly ?string $userName;
	readonly ?string $userSurname;
	readonly string $userEmail;
	readonly string $userAddress;
	readonly string $productTitle;

	/**
	 * @param int $id
	 * @param string $dataCreate
	 * @param float $price
	 * @param string|null $userName
	 * @param string|null $userSurname
	 * @param string $userEmail
	 * @param string $userAddress
	 * @param string $productTitle
	 */
	public function __construct(
		int     $id,
		string  $dataCreate,
		float   $price,
		?string $userName,
		?string $userSurname,
		string  $userEmail,
		string  $userAddress,
		string  $productTitle
	)
	{
		$this->id = $id;
		$this->dataCreate = $dataCreate;
		$this->price = $price;
		$this->userName = $userName ?? null;
		$this->userSurname = $userSurname ?? null;
		$this->userEmail = $userEmail;
		$this->userAddress = $userAddress;
		$this->productTitle = $productTitle;
	}

}