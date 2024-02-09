<?php

declare(strict_types=1);

namespace Up\Services\Repository;

use Exception;
use Core\DB\DbConnection;
use Up\Models\Order;
use Up\Services\SecurityService;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public static function addOrder(): ?array
	{
		try {
			$errors = [];

			$userName = SecurityService::safeString($_POST['name']);
			$userSurname = SecurityService::safeString($_POST['surname']);
			$userEmail = SecurityService::safeString($_POST['email']);
			$userAddress = SecurityService::safeString($_POST['address']);
			$productID = SecurityService::safeString($_POST['productID']);
			$productPrice = SecurityService::safeString($_POST['productPrice']);

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

	/**
	 * @throws Exception
	 */
	public static function getOrderList(): array
	{
		$query = "SELECT O.`ID`, O.`DATE_CREATE`, O.`PRICE`,"
			." U.`NAME`, U.`SURNAME`, U.`EMAIL`, U.`ADDRESS`, P.`TITLE` "
			." FROM `ORDER` O INNER JOIN `USER` U ON O.`USER_ID` = U.`ID`"
			." INNER JOIN `PRODUCT_ORDER` PR ON O.`ID` = PR.`ORDER_ID`"
			. "INNER JOIN `PRODUCT` P ON PR.PRODUCT_ID = P.ID";

		$result = SecurityService::safeSelectQuery($query);

		$orders = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$orders[] = new Order((int)$row['ID'], $row['DATE_CREATE'],
								  (float)$row['PRICE'], $row['NAME'],
								  $row['SURNAME'], $row['EMAIL'],
								  $row['ADDRESS'], $row['TITLE']);
		}
		return $orders;
	}
	public static function addOrderUnregistered(): ?array
	{
		try {
			$errors = [];
			$userEmail = htmlspecialchars($_POST['email'],ENT_QUOTES);
			$userAddress = htmlspecialchars($_POST['address'],ENT_QUOTES);
			$productID = htmlspecialchars($_POST['productID'],ENT_QUOTES);
			$productPrice = htmlspecialchars($_POST['productPrice'],ENT_QUOTES);

			$connection = DbConnection::get();



			$orderQuery = "INSERT INTO `ORDER` (`PRICE`, `USER_ID`, `PRODUCT_ID`,`EMAIL`, `ADDRESS`, `STATUS_ID`, `ENTITY_STATUS_ID`, `DATE_CREATE`)"
				. " VALUES ('{$productPrice}', null, '{$productID}',$userAddress, '{$userAddress}', 1, 1, NOW())";

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