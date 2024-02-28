<?php

declare(strict_types=1);

namespace Up\Services;

use Core\Http\Request;
use Exception;
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

		$isTitleEmpty = empty($title);
		$isDescriptionEmpty = empty($description);
		$isPriceEmpty = empty($price);
		$isBrandEmpty = empty($brand);
		$isTagsEmpty = empty($tags);

		$isPriceNegative = $price < 0;

		if ($isTitleEmpty || $isDescriptionEmpty || $isPriceEmpty)
		{
			throw new RuntimeException("Error adding product: All fields must be filled");
		}

		if ($isPriceNegative)
		{
			throw new RuntimeException("Error adding product: Price cannot be negative");
		}

		if ($isBrandEmpty)
		{
			throw new RuntimeException("Error adding product: Brand must be selected");
		}

		if ($isTagsEmpty)
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
		$isProductTitleEmpty = empty(trim($productTitle));

		if ($isProductTitleEmpty)
		{
			throw new RuntimeException("Error search: Fields search must be filled");
		}

		return $productTitle;
	}

	/**
	 * @throws Exception
	 */
	public static function getRegisterError($userName, $userSurname, $userEmail, $userPassword, $userAddress): void
	{
		$isValidEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);

		$userExists = UserService::getUserByEmail($userEmail);

		$isValidName = preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userName);
		$isValidSurname = preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userSurname);

		$isUserNameEmpty = empty(trim($userName));
		$isUserPasswordEmpty = empty(trim($userPassword));
		$isUserSurnameEmpty = empty(trim($userSurname));
		$isUserAddressEmpty = empty(trim($userAddress));

		$isValidUserNameLength = mb_strlen($userName) > 30;
		$isValidUserSurnameLength = mb_strlen($userSurname) > 30;
		$isValidUserAddressLength = mb_strlen($userAddress) > 100;
		$isValidUserEmailLength = mb_strlen($userEmail) > 100;
		$isValidUserPasswordLength = mb_strlen($userPassword) > 200;

		if (!$isValidEmail)
		{
			throw new RuntimeException("Invalid Email");
		}

		if ($userExists)
		{
			throw new RuntimeException("User already exists");
		}

		if (!$isValidName || !$isValidSurname)
		{
			throw new RuntimeException("Enter data in the specified format");
		}

		if ($isUserNameEmpty || $isUserSurnameEmpty || $isUserAddressEmpty || $isUserPasswordEmpty)
		{
			throw new RuntimeException("Fill in all the fields");
		}

		if (
			$isValidUserNameLength
			|| $isValidUserSurnameLength
			|| $isValidUserAddressLength
			|| $isValidUserEmailLength
			|| $isValidUserPasswordLength
		)
		{
			throw new RuntimeException("Invalid field length");
		}
	}
}