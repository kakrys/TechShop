<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\Tag;
use Core\DB\QueryBuilder;

class TagService
{
	/**
	 * @return Tag[]
	 * @throws Exception
	 */
	public static function getTagList(): array
	{

		$query = "SELECT `ID`,`Title` from TAG";

		$result = QueryBuilder::select($query);

		$tags = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$tags[] = new Tag($row['ID'], $row['Title'], null);
		}

		return $tags;
	}
}