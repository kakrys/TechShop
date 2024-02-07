<?php

declare(strict_types=1);

namespace Up\Services;

class PaginationService
{


	public static function determinePage(int $pageNumber, array $productArray): array
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

		if (count($productArray) === 10)
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

	public static function trimProductArray(array $productArray): array
	{
		$productArraySize = count($productArray);
		$productArrayLimit = 10;

		if ($productArraySize === $productArrayLimit)
		{
			array_pop($productArray);
		}
		return $productArray;
	}
}
