<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Services\SecurityService;

class UpdateProductService
{
	/**
	 * @throws Exception
	 */
	public static function update(int $id, string $title, float $price, string $description): bool
	{
		$table = 'PRODUCT';
		$data = [
			'TITLE' => $title,
			'DESCRIPTION' => $description,
			'PRICE' => $price,
			'DATE_UPDATE' => date('Y-m-d H:i:s'),
		];
		$condition = '`ID` = ?';
		$params = [$id];

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}
}