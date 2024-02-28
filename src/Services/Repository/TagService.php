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

		$query = "SELECT ID, TITLE FROM TAG";

		$result = QueryBuilder::select($query);

		$tags = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$tags[] = new Tag($row['ID'], $row['TITLE'], null);
		}

		return $tags;
	}
	public static function getProductTags($productId):array
	{
		$query = "SELECT TAG.ID as tagId, TITLE"
			. " FROM TAG INNER JOIN PRODUCT_TAG"
			. " ON TAG.ID = PRODUCT_TAG.TAG_ID"
			. " WHERE PRODUCT_ID = ?";

		$tagResult = QueryBuilder::select($query, [$productId], true);
		$tags = [];
		while ($tagRow = mysqli_fetch_assoc($tagResult))
		{
			$tag = new Tag($tagRow['tagId'], $tagRow['TITLE'], null);
			$tags[]=$tag;
		}

	return $tags;
	}
}