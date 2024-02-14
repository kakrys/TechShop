<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\Brand;
use Core\DB\SafeQueryBuilder;

class BrandService
{

	/**
	 * @return Brand[]
	 * @throws Exception
	 */
	public static function getBrandList(): array
	{
		$query = "SELECT `ID`,`Title` from BRAND";

		$result = SafeQueryBuilder::Select($query);

		$brands = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$brands[] = new Brand($row['ID'], $row['Title'], null);
		}

		return $brands;
	}
}