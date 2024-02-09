<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
class UpdateProductService
{
	private static $connection;
	public static function update(int $id, string $title, float $price, string $description):void
	{
		self::$connection = DbConnection::get();

		$updateQuery = "UPDATE `PRODUCT`
						SET `TITLE` = COALESCE(?, `TITLE`),
						`DESCRIPTION` = COALESCE(?, `DESCRIPTION`),
						`PRICE` = COALESCE(?, `PRICE`),
						`DATE_UPDATE` = CURRENT_TIME()
						WHERE `ID` = ?;";

		$stmt = self::$connection->prepare($updateQuery);
		$stmt->bind_param('ssdi', $title, $description, $price, $id);
		$stmt->execute();
	}
}