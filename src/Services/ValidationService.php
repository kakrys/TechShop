<?php

declare(strict_types=1);

namespace Up\Services;

use Core\Http\Request;
use RuntimeException;
use Up\Services\Repository\UserService;

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

	public static function getValidateProductTitle(?string $productTitle): string
	{
		if (empty(trim($productTitle)))
		{
			throw new RuntimeException("Error search: Fields search must be filled");
		}

		return $productTitle;
	}

	/**
	 * @throws \Exception
	 */
	public static function getRegisterError($userName, $userSurname, $userEmail, $userPassword, $userAddress): ?string
	{
		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
		{
			return 'Invalid Email';
		}

		if (UserService::getUserByEmail($userEmail))
		{
			return 'User already exists';
		}

		if (!preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userName) || !preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userSurname))
		{
			return 'Enter data in the specified format';
		}

		if (
			trim($userName) === '' || trim($userPassword) === '' || trim($userSurname) === ''
			|| trim($userAddress) === ''
		)
		{
			return 'Fill in all the fields';
		}

		if (
			strlen($userName) > 60 || strlen($userSurname) > 60 || strlen($userAddress) > 200
			|| strlen($userEmail) > 100
			|| strlen($userPassword) > 400
		)
		{
			return 'Invalid field length';
		}

		return null;
	}
}