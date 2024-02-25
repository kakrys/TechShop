<?php

declare(strict_types=1);

namespace Up\Services\Repository;

use Exception;
use Up\Models\Order;
use Core\Http\Request;
use Core\DB\MysqlConnection;
use Core\DB\QueryBuilder;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public static function getOrderList($userID = null, $pageNumber = 1): array
	{
		$perPage = 4;
		$offset = ($pageNumber - 1) * $perPage;

		$query = "SELECT O.`ID`, O.`DATE_CREATE`, O.`PRICE`,"
			. " U.`NAME`, U.`SURNAME`, O.`EMAIL`, O.`ADDRESS`, P.`TITLE` "
			. " FROM `ORDER` O left JOIN `USER` U ON O.`USER_ID` = U.`ID`"
			. " INNER JOIN `PRODUCT_ORDER` PR ON O.`ID` = PR.`ORDER_ID`"
			. " INNER JOIN `PRODUCT` P ON PR.PRODUCT_ID = P.ID";

		if ($userID !== null)
		{

			$query .= " WHERE U.ID = ? LIMIT 5 OFFSET ?";
			$params = [$userID, $offset];
		}
		else
		{
			$query .= "  LIMIT 5 OFFSET ?";
			$params = [$offset];
		}
		$result = QueryBuilder::select($query, $params, true);

		$orders = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$orders[] = new Order(
				(int)$row['ID'],
				$row['DATE_CREATE'],
				(float)$row['PRICE'],
				$row['NAME'],
				$row['SURNAME'],
				$row['EMAIL'],
				$row['ADDRESS'],
				$row['TITLE']
			);
		}

		return $orders;
	}
	public static function addOrder(): ?array
	{
		try
		{
			$request = Request::getBody();
			$userID = $request['id'];
			$userEmail = $request['email'];
			$userAddress = $request['address'];
			$productID = $request['productID'];
			$productPrice = $request['productPrice'];
			if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL) || trim($userAddress) === '')
			{
				return ['An error has occurred'];
			}

			$orderData = self::buildOrderData($userID, $userEmail, $userAddress, $productID, $productPrice);
			$errors = self::saveOrderAndProductLink($orderData, $productID);

			return !empty($errors) ? $errors : null;
		}
		catch (Exception $e)
		{
			return ['An error has occurred: ' . $e->getMessage()];
		}
	}

	public static function addOrderUnauthorised(): ?array
	{
		try
		{
			$request = Request::getBody();
			$userEmail = $request['email'];
			$userAddress = $request['address'];
			$productID = $request['productID'];
			$productPrice = $request['productPrice'];
			if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL) || trim($userAddress) === '')
			{
				return ['An error has occurred'];
			}

			$orderData = self::buildOrderData(null, $userEmail, $userAddress, $productID, $productPrice);
			$errors = self::saveOrderAndProductLink($orderData, $productID);

			return !empty($errors) ? $errors : null;
		}
		catch (Exception $e)
		{
			return ['An error has occurred: ' . $e->getMessage()];
		}
	}

	private static function buildOrderData($userID, $userEmail, $userAddress, $productID, $productPrice): array
	{
		return [
			'PRICE' => $productPrice,
			'USER_ID' => $userID,
			'PRODUCT_ID' => $productID,
			'EMAIL' => $userEmail,
			'ADDRESS' => $userAddress,
			'STATUS_ID' => 1,
			'ENTITY_STATUS_ID' => 1,
			'DATE_CREATE' => date('Y-m-d H:i:s'),
		];
	}

	/**
	 * @throws Exception
	 */
	private static function saveOrderAndProductLink(array $orderData, $productID): ?array
	{
		$errors = [];
		if (!QueryBuilder::insert('`ORDER`', $orderData, true))
		{
			$errors[] = 'Error adding an order: ' . MysqlConnection::get()->error;
		}

		$orderID = MysqlConnection::get()->insert_id;

		$productOrderData = [
			'PRODUCT_ID' => $productID,
			'ORDER_ID' => $orderID,
		];

		if (!QueryBuilder::insert('`PRODUCT_ORDER`', $productOrderData, true))
		{
			$errors[] = 'Error adding a product/order link: ' . MysqlConnection::get()->error;
		}

		return $errors;
	}
}