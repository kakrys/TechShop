<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\Brand;
use Core\DB\QueryBuilder;

class BrandService
{

	/**
	 * @return Brand[]
	 * @throws Exception
	 */
	public static function getBrandList(): array
	{
		$query = "SELECT `ID`,`TITLE` FROM BRAND";

		$result = QueryBuilder::select($query);

		$brands = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$brands[] = new Brand($row['ID'], $row['TITLE'], null);
		}

		return $brands;
	}
	public static function getBrandId($name):int
	{
		$query = "SELECT `ID`FROM BRAND where TITLE=?";
		$params = [$name];
		$result = QueryBuilder::select($query, $params, true);
		return mysqli_fetch_assoc($result)['ID'];
	}
}