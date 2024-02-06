<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;

class BrandService
{

	/**
	 * @return \Up\Models\Brand[]
	 * @throws Exception
	 */
	public static function getBrandList(): array
	{
		$connection = DbConnection::get();

		$query = "SELECT `ID`,`Title` from BRAND";

		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}
		$brands = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$brands[] = new \Up\Models\Brand($row['ID'], $row['Title'], null);
		}

		return $brands;
	}
}