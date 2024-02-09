<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Services\SecurityService;

class BrandService
{

	/**
	 * @return \Up\Models\Brand[]
	 * @throws Exception
	 */
	public static function getBrandList(): array
	{
		$query = "SELECT `ID`,`Title` from BRAND";

		$result = SecurityService::safeSelectQuery($query);

		$brands = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$brands[] = new \Up\Models\Brand($row['ID'], $row['Title'], null);
		}

		return $brands;
	}
}