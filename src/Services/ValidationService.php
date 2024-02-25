<?php

declare(strict_types=1);

namespace Up\Services;

use Core\Http\Request;
use RuntimeException;

class ValidationService
{
	public static function getValidateProductCreationParams(): array
	{
		$request = Request::getBody();
		$title = trim($request['name']);
		$description = trim($request["description"]);
		$price = trim($request["price"]);
		$tags = $request["tags"] ?? [];
		$brand = $request["brand"];

		if (empty($title) || empty($description) || empty($price))
		{
			throw new RuntimeException("Error adding product: All fields must be filled");
		}

		if ($price < 0)
		{
			throw new RuntimeException("Error adding product: Price cannot be negative or zero");
		}

		if (empty($brand))
		{
			throw new RuntimeException("Error adding product: Brand must be selected");
		}

		if (empty($tags))
		{
			throw new RuntimeException("Error adding product: At least one tag must be selected");
		}

		return [
			'title' => $title,
			'description' => $description,
			'price' => $price,
			'tags' => $tags,
			'brand' => $brand,
		];
	}
}