<?php

namespace Up\Models;

class Order
{
	private int $id;
	private float $price;
	private int $userId;
	private array $productId;
	private int $adress;
	private int $statusId;
	private int $entityStatusId;

}