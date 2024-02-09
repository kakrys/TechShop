<?php

declare(strict_types=1);

namespace Up\Services\Repository;

use Core\Http\Request;
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
		$request = Request::getBody();
		try {
			$errors = [];

			$userName = SecurityService::safeString($request['name']);
			$userSurname = SecurityService::safeString($request['surname']);
			$userEmail = SecurityService::safeString($request['email']);
			$userAddress = SecurityService::safeString($request['address']);
			$productID = SecurityService::safeString($request['productID']);
			$productPrice = SecurityService::safeString($request['productPrice']);

			$userData = [
				'NAME' => $userName,
				'SURNAME' => $userSurname,
				'EMAIL' => $userEmail,
				'PASSWORD' => 'password',
				'ADDRESS' => $userAddress,
				'ROLE_ID' => 2,
				'ENTITY_STATUS_ID' => 1,
			];

			if (!SecurityService::safeInsertQuery('USER', $userData))
			{
				$errors[] = 'Error adding user: ' . DbConnection::get()->error;
			}

			$userID = DbConnection::get()->insert_id;

			$orderData = [
				'PRICE' => $productPrice,
				'USER_ID' => $userID,
				'PRODUCT_ID' => $productID,
				'ADDRESS' => $userAddress,
				'STATUS_ID' => 1,
				'ENTITY_STATUS_ID' => 1,
				'DATE_CREATE' =>  date('Y-m-d H:i:s'),
			];

			if (!SecurityService::safeInsertQuery('`ORDER`', $orderData))
			{
				$errors[] = 'Error adding an order: ' . DbConnection::get()->error;
			}

			$orderID = DbConnection::get()->insert_id;

			$productOrderData = [
				'PRODUCT_ID' => $productID,
				'ORDER_ID' => $orderID,
			];

			if (!SecurityService::safeInsertQuery('`PRODUCT_ORDER`', $productOrderData))
			{
				$errors[] = 'Error adding a product/order link: ' . DbConnection::get()->error;
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
		$request = Request::getBody();
		try {
			$errors = [];
			$userEmail = htmlspecialchars($request['email'],ENT_QUOTES);
			$userAddress = htmlspecialchars($request['address'],ENT_QUOTES);
			$productID = htmlspecialchars($request['productID'],ENT_QUOTES);
			$productPrice = htmlspecialchars($request['productPrice'],ENT_QUOTES);

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