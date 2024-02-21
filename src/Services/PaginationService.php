<?php

declare(strict_types=1);

namespace Up\Services;

class PaginationService
{
	public static function determinePage(int $pageNumber, array $productArray,$count=10): array
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

		if (count($productArray) === $count)
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

	public static function trimProductArray(array $productArray,$productArrayLimit = 10): array
	{
		$productArraySize = count($productArray);
//		$productArrayLimit = 10;

		if ($productArraySize === $productArrayLimit)
		{
			array_pop($productArray);
		}

		return $productArray;
	}
}
