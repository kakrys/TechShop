<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;


class RemoveService
{
	private static $connection;

	public static function delete(int $id)
	{
		self::$connection = DbConnection::get();
		ImageService::deleteImage($id);
		// Удаление изображений
		$deleteImageQuery = "DELETE FROM `IMAGE` WHERE `IMAGE`.`PRODUCT_ID` = ?;";
		$stmt = self::$connection->prepare($deleteImageQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		// Удаление тегов
		$deleteTagQuery = "DELETE FROM `PRODUCT_TAG` WHERE `PRODUCT_TAG`.`PRODUCT_ID` = ?;";
		$stmt = self::$connection->prepare($deleteTagQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		// Удаление продукта
		$deleteProductQuery = "DELETE FROM `PRODUCT` WHERE `PRODUCT`.`ID` = ?;";
		$stmt = self::$connection->prepare($deleteProductQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		return $stmt->affected_rows;
	}
}
