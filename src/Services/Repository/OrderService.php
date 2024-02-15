<?php

declare(strict_types=1);

namespace Up\Services\Repository;

use Exception;
use Up\Models\Order;
use Core\Http\Request;
use Core\DB\DbConnection;
use Core\DB\SafeQueryBuilder;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public static function addOrder(): ?array
	{
		$request = Request::getBody();
		try
		{
			$errors = [];

			$userID = $request['id'];
			$userEmail = $request['email'];
			$userAddress = $request['address'];
			$productID = $request['productID'];
			$productPrice = $request['productPrice'];

			$orderData = [
				'PRICE' => $productPrice,
				'USER_ID' => $userID,
				'PRODUCT_ID' => $productID,
				'EMAIL' => $userEmail,
				'ADDRESS' => $userAddress,
				'STATUS_ID' => 1,
				'ENTITY_STATUS_ID' => 1,
				'DATE_CREATE' => date('Y-m-d H:i:s'),
			];

			if (!SafeQueryBuilder::Insert('`ORDER`', $orderData))
			{
				$errors[] = 'Error adding an order: ' . DbConnection::get()->error;
			}

			$orderID = DbConnection::get()->insert_id;

			$productOrderData = [
				'PRODUCT_ID' => $productID,
				'ORDER_ID' => $orderID,
			];

			if (!SafeQueryBuilder::Insert('`PRODUCT_ORDER`', $productOrderData))
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
	public static function getOrderList($userEmail = null): array
	{
		$query = "SELECT O.`ID`, O.`DATE_CREATE`, O.`PRICE`,"
			. " U.`NAME`, U.`SURNAME`, O.`EMAIL`, O.`ADDRESS`, P.`TITLE` "
			. " FROM `ORDER` O left JOIN `USER` U ON O.`USER_ID` = U.`ID`"
			. " INNER JOIN `PRODUCT_ORDER` PR ON O.`ID` = PR.`ORDER_ID`"
			. "INNER JOIN `PRODUCT` P ON PR.PRODUCT_ID = P.ID";

		if ($userEmail !== null)
		{
			$query .= " WHERE O.EMAIL=?";
			$params = [$userEmail];
			$result = SafeQueryBuilder::Select($query, $params);
		}
		else
		{
			$result = SafeQueryBuilder::Select($query);
		}

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

	public static function addOrderUnauthorised(): ?array
	{
		$request = Request::getBody();
		try
		{
			$errors = [];
			$userEmail = $request['email'];
			$userAddress = $request['address'];
			$productID = $request['productID'];
			$productPrice = $request['productPrice'];

			$orderData = [
				'PRICE' => $productPrice,
				'USER_ID' => null,
				'PRODUCT_ID' => $productID,
				'EMAIL' => $userEmail,
				'ADDRESS' => $userAddress,
				'STATUS_ID' => 1,
				'ENTITY_STATUS_ID' => 1,
				'DATE_CREATE' => date('Y-m-d H:i:s'),
			];

			if (!SafeQueryBuilder::Insert('`ORDER`', $orderData))
			{
				$errors[] = 'Error adding an order: ' . DbConnection::get()->error;
			}

			$orderID = DbConnection::get()->insert_id;

			$productOrderData = [
				'PRODUCT_ID' => $productID,
				'ORDER_ID' => $orderID,
			];

			if (!SafeQueryBuilder::Insert('`PRODUCT_ORDER`', $productOrderData))
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
}