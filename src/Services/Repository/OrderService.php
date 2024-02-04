<?php

declare(strict_types=1);

namespace Up\Services\Repository;

use Exception;
use Core\DB\DbConnection;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public static function addOrder(): ?array
	{
		try {
			$errors = [];

			$userName = $_POST['name'];
			$userSurname = $_POST['surname'];
			$userEmail = $_POST['email'];
			$userAddress = $_POST['address'];
			$productID = $_POST['productID'];
			$productPrice = $_POST['productPrice'];

			$connection = DbConnection::get();
			$userAddQuery = "INSERT INTO `USER` (`NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `ROLE_ID`, `ENTITY_STATUS_ID`)"
				. " VALUES ('{$userName}', '{$userSurname}', '{$userEmail}', 'password', '{$userAddress}', 2, 1)";

			if (!$connection->query($userAddQuery))
			{
				$errors[] = 'Error adding user: ' . $connection->error;
			}

			$userID = $connection->insert_id;

			$orderQuery = "INSERT INTO `ORDER` (`PRICE`, `USER_ID`, `PRODUCT_ID`, `ADDRESS`, `STATUS_ID`, `ENTITY_STATUS_ID`, `DATE_CREATE`)"
				. " VALUES ('{$productPrice}', {$userID}, '{$productID}', '{$userAddress}', 1, 1, NOW())";

			if (!$connection->query($orderQuery))
			{
				$errors[] = 'Error adding an order: ' . $connection->error;
			}

			$orderID = $connection->insert_id;

			$productOrderQuery = "INSERT INTO `PRODUCT_ORDER` (`PRODUCT_ID`, `ORDER_ID`) VALUES ('{$productID}', {$orderID})";

			if (!$connection->query($productOrderQuery))
			{
				$errors[] = 'Error adding a product/order link: ' . $connection->error;
			}
			return !empty($errors) ? $errors : null;
		}
		catch (Exception $e)
		{
			return ['An error has occurred: ' . $e->getMessage()];
		}
	}
}