<?php

namespace Up\Services\Repository;

use Exception;
use Up\Services\SecurityService;

class TagService
{
	/**
	 * @return \Up\Models\Tag[]
	 * @throws Exception
	 */
	public static function getTagList(): array
	{

		$query = "SELECT `ID`,`Title` from TAG";

		$result = SecurityService::safeSelectQuery($query);

		$tags = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$tags[] = new \Up\Models\Tag($row['ID'], $row['Title'], null);
		}

		return $tags;
	}
}