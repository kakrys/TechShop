<?php

declare(strict_types=1);

namespace Up\Services;

class PaginationService
{
	public static function determinePage(int $pageNumber, array $paginationArray, $count = 10): array
	{
		$pageArray = [];
		if ($pageNumber === 1)
		{
			$prevPage = 1;
		}
		else
		{
			$prevPage = $pageNumber - 1;
		}

		if (count($paginationArray) === $count)
		{
			$nextPage = $pageNumber + 1;
		}
		else
		{
			$nextPage = $pageNumber;
		}
		$pageArray[] = $prevPage;
		$pageArray[] = $nextPage;

		return ($pageArray);
	}

	public static function trimPaginationArray(array $paginationArray, $productArrayLimit = 10): array
	{
		$productArraySize = count($paginationArray);
//		$productArrayLimit = 10;

		if ($productArraySize === $productArrayLimit)
		{
			array_pop($paginationArray);
		}

		return $paginationArray;
	}
}
