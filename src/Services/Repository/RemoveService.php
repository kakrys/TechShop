<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use RuntimeException;
use Up\Services\SecurityService;

class RemoveService
{

	/**
	 * @throws Exception
	 */
	public static function delete(int $id): void
	{
		ImageService::deleteImage($id);

		// Удаление изображений
		if (!SecurityService::safeDeleteQuery('`IMAGE`','`IMAGE`.`PRODUCT_ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete image:  ' . DbConnection::get()->error);
		}

		// Удаление тегов
		if (!SecurityService::safeDeleteQuery('`PRODUCT_TAG`','`PRODUCT_TAG`.`PRODUCT_ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete product_tag:  ' . DbConnection::get()->error);
		}

		// Удаление продукта
		if (!SecurityService::safeDeleteQuery('`PRODUCT`','`PRODUCT`.`ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete product:  ' . DbConnection::get()->error);
		}
	}
}
