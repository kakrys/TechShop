<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\Tag;
use Core\DB\SafeQueryBuilder;

class TagService
{
	/**
	 * @return Tag[]
	 * @throws Exception
	 */
	public static function getTagList(): array
	{

		$query = "SELECT `ID`,`Title` from TAG";

		$result = SafeQueryBuilder::Select($query);

		$tags = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$tags[] = new Tag($row['ID'], $row['Title'], null);
		}

		return $tags;
	}
}