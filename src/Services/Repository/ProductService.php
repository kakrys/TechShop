<?php

namespace Up\Services\Repository;

use Exception;
use mysqli_result;
use RuntimeException;

use Up\Models\Tag;
use Up\Models\Image;
use Up\Models\Product;

use Core\DB\MysqlConnection;
use Core\DB\QueryBuilder;
use Up\Services\ValidationService;

class ProductService
{
	/**
	 * @throws Exception
	 */
	public static function getProductList(
		int     $pageNumber,
		string  $category,
		?array  $brands,
		?string $sortBy = null
	): array
	{
		$perPage = 9;
		$offset = ($pageNumber - 1) * $perPage;
		$brandsIsNull = $brands === null;

		if (!$brandsIsNull)
		{
			$placeholders = implode(",", array_fill(0, count($brands), "?"));
			$brandCondition = "AND PRODUCT.BRAND_ID IN ($placeholders)";
		}
		else
		{
			$brandCondition = "";
		}

		$sortString = self::generateSortingOrder($sortBy);

		if ($category === 'all')
		{
			$query = "SELECT PRODUCT.ID, TITLE, PRICE, PATH"
				. " FROM PRODUCT"
				. " INNER JOIN IMAGE"
				. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
				. " WHERE IS_COVER = 1 $brandCondition"
				. " AND PRODUCT.ENTITY_STATUS_ID = 1 "
				. $sortString
				. " LIMIT 10 OFFSET $offset ";

			$params = [];
		}
		else
		{
			$query = "SELECT PRODUCT.ID, PRODUCT.TITLE, PRICE, PATH"
				. " FROM PRODUCT"
				. " INNER JOIN IMAGE"
				. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
				. " INNER JOIN PRODUCT_TAG"
				. " ON PRODUCT.ID = PRODUCT_TAG.PRODUCT_ID"
				. " INNER JOIN TAG ON PRODUCT_TAG.TAG_ID = TAG.ID"
				. " WHERE IS_COVER = 1 AND TAG.TITLE = ? $brandCondition"
				. " AND PRODUCT.ENTITY_STATUS_ID = 1 "
				. $sortString
				. " LIMIT 10 OFFSET $offset";

			$params = [$category];
		}

		if ($brands !== null)
		{
			$params = array_merge($params, $brands);
		}

		$result = QueryBuilder::select($query, $params, true);

		return self::fetchProductsFromResult($result);
	}

	/**
	 * @throws Exception
	 */
	public static function getProductInfoByID(int|string $id): ?Product
	{
		if (is_string($id) && !is_numeric($id))
		{
			return null;
		}
		$query = "SELECT PRODUCT.ID, PRODUCT.TITLE, PRICE, DESCRIPTION, BRAND.TITLE AS BRAND, PATH"
			. " FROM PRODUCT INNER JOIN BRAND ON PRODUCT.BRAND_ID = BRAND.ID"
			. " INNER JOIN IMAGE"
			. " ON PRODUCT.ID=IMAGE.PRODUCT_ID"
			. " WHERE PRODUCT.ID = ? AND IMAGE.IS_COVER = 1";

		$result = QueryBuilder::select($query, [$id], true);

		$row = mysqli_fetch_assoc($result);
		if (!isset($row['ID']))
		{
			return null;
		}
		$cover = new Image(null, $row['ID'], $row['PATH'], 1);
		$product = new Product(
			$row['ID'],
			$row['TITLE'],
			$row['DESCRIPTION'],
			$row['PRICE'],
			null,
			null,
			null,
			null,
			null,
			$row['BRAND'],
			$cover,
			null
		);

		$query = "SELECT TITLE"
			. " FROM TAG INNER JOIN PRODUCT_TAG"
			. " ON TAG.ID = PRODUCT_TAG.TAG_ID"
			. " WHERE PRODUCT_ID = ?";

		$tags = QueryBuilder::select($query, [$id], true);

		while ($row = mysqli_fetch_assoc($tags))
		{
			$tag = new Tag(null, $row['TITLE'], null);
			$product->addTag($tag);

		}

		return $product;
	}

	/**
	 * @throws Exception
	 */
	public static function getProductListForAdmin(int $pageNumber): array
	{
		$perPage = 9;
		$offset = ($pageNumber - 1) * $perPage;

		$query = "SELECT PRODUCT.ID, PRODUCT.TITLE, PRICE, PATH, DESCRIPTION, BRAND.TITLE"
			. " AS BRAND, PRODUCT.ENTITY_STATUS_ID"
			. " FROM PRODUCT INNER JOIN BRAND ON PRODUCT.BRAND_ID = BRAND.ID"
			. " INNER JOIN IMAGE"
			. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
			. " WHERE IS_COVER = 1 "
			. " LIMIT 10 OFFSET $offset";

		$result = QueryBuilder::select($query);

		return self::fetchProductsFromResult($result, true, true, true, true);
	}

	/**
	 * @throws Exception
	 */
	public static function addProduct(): void
	{
		$productsParams = ValidationService::getValidateProductCreationParams();

		$productData = [
			'TITLE' => $productsParams['title'],
			'DESCRIPTION' => $productsParams['description'],
			'PRICE' => $productsParams['price'],
			'ENTITY_STATUS_ID' => 1,
			'SORT_ORDER' => 1,
			'BRAND_ID' => $productsParams['brand'],
		];

		if (!QueryBuilder::insert('PRODUCT', $productData, true))
		{
			throw new RuntimeException('Error adding an product:  ' . MysqlConnection::get()->error);
		}

		$product_ID = MysqlConnection::get()->insert_id;

		$tags = $productsParams['tags'];
		foreach ($tags as $tagId)
		{
			$productTagData = [
				'PRODUCT_ID' => $product_ID,
				'TAG_ID' => $tagId,
			];
			if (!QueryBuilder::insert('PRODUCT_TAG', $productTagData, true))
			{
				throw new RuntimeException('Error adding an product:  ' . MysqlConnection::get()->error);
			}
		}
		if(ImageService::checkIfImage())
		{
			$imageName = ImageService::renameImage();
			ImageService::insertImageInFolder($imageName);
			ImageService::insertImageInDatabase($product_ID, $imageName, 1);
			$additionalImages = ImageService::renameAndSendAddImages();
			if ($additionalImages !== [])
			{
				foreach ($additionalImages as $additionalImage)
				{
					ImageService::insertImageInDatabase($product_ID, $additionalImage, 0);
				}
			}
		}


	}

	/**
	 * @throws Exception
	 */
	public static function getProductsByTitle(
		$pageNumber,
		?string $productTitle,
		?string $category = null,
		?array $brands = null,
		?string $sortBy = null
	): array
	{
		$offset = ($pageNumber - 1) * 9;
		$brandsIsNull = $brands === null;

		if (!$brandsIsNull)
		{
			$placeholders = implode(",", array_fill(0, count($brands), "?"));
			$brandCondition = "AND PRODUCT.BRAND_ID IN ($placeholders)";
		}
		else
		{
			$brandCondition = "";
		}

		$sortString = self::generateSortingOrder($sortBy);

		if ($category === 'all')
		{
			$query = "SELECT TITLE, PRODUCT.ID,PRICE, DESCRIPTION, PATH"
				. " FROM PRODUCT"
				. " INNER JOIN IMAGE"
				. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
				. " WHERE TITLE LIKE ? AND IS_COVER = 1 $brandCondition"
				. " AND PRODUCT.ENTITY_STATUS_ID = 1 "
				. $sortString
				. " LIMIT 10 OFFSET $offset";

			$params = ["%$productTitle%"];
		}
		else
		{
			$query = "SELECT PRODUCT.TITLE, PRODUCT.ID,PRICE, DESCRIPTION, PATH"
				. " FROM PRODUCT"
				. " INNER JOIN IMAGE"
				. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
				. " INNER JOIN PRODUCT_TAG"
				. " ON PRODUCT.ID = PRODUCT_TAG.PRODUCT_ID"
				. " INNER JOIN TAG ON PRODUCT_TAG.TAG_ID = TAG.ID"
				. " WHERE PRODUCT.TITLE LIKE ? AND IS_COVER = 1"
				. " AND TAG.TITLE = ? $brandCondition"
				. " AND PRODUCT.ENTITY_STATUS_ID = 1 "
				. $sortString
				. " LIMIT 10 OFFSET $offset ";

			$params = ["%$productTitle%", $category];
		}
		if ($brands !== null)
		{
			$params = array_merge($params, $brands);
		}
		$result = QueryBuilder::select($query, $params, true);

		return self::fetchProductsFromResult($result, true);
	}

	/**
	 * @throws Exception
	 */
	public static function updateProductByID(
		int    $id,
		string $title,
		float  $price,
		string $description,
		int    $brandId,
		array  $tags
	): bool
	{
		$table = 'PRODUCT';
		$data = [
			'TITLE' => $title,
			'DESCRIPTION' => $description,
			'PRICE' => $price,
			'DATE_UPDATE' => date('Y-m-d H:i:s'),
			'BRAND_ID' => $brandId,
		];
		$condition = '`ID` = ?';
		$params = [$id];
		if (!QueryBuilder::delete('PRODUCT_TAG', 'PRODUCT_TAG.PRODUCT_ID = ?', $params, true))
		{
			throw new RuntimeException('Error delete product_tag:  ' . MysqlConnection::get()->error);
		}
		foreach ($tags as $tagId)
		{
			$productTagData = [
				'PRODUCT_ID' => $id,
				'TAG_ID' => $tagId,
			];
			if (!QueryBuilder::insert('PRODUCT_TAG', $productTagData, true))
			{
				throw new RuntimeException('Error adding an product:  ' . MysqlConnection::get()->error);
			}
		}

		return QueryBuilder::update($table, $data, $condition, $params, true);

	}

	/**
	 * @throws Exception
	 */
	public static function deleteProductByID(int $id): void
	{

		ImageService::deleteImage($id);

		// Удаление изображений
		if (!QueryBuilder::delete('`IMAGE`', '`IMAGE`.`PRODUCT_ID` = ?', [$id], true))
		{
			throw new RuntimeException('Error delete image:  ' . MysqlConnection::get()->error);
		}

		// Удаление тегов
		if (!QueryBuilder::delete('`PRODUCT_TAG`', '`PRODUCT_TAG`.`PRODUCT_ID` = ?', [$id], true))
		{
			throw new RuntimeException('Error delete product_tag:  ' . MysqlConnection::get()->error);
		}

		// Удаление продукта
		if (!QueryBuilder::delete('`PRODUCT`', '`PRODUCT`.`ID` = ?', [$id], true))
		{
			throw new RuntimeException('Error delete product:  ' . MysqlConnection::get()->error);
		}
	}

	/**
	 * @throws Exception
	 */
	public static function getNewProducts(): array
	{
		$query = "SELECT PRODUCT.ID, TITLE, PRICE, PATH"
			. " FROM PRODUCT INNER JOIN IMAGE"
			. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
			. " WHERE IS_COVER = 1"
			. " AND PRODUCT.ENTITY_STATUS_ID = 1 "
			. " ORDER BY DATE_RELEASE DESC"
			. " LIMIT 5";

		$result = QueryBuilder::select($query);

		return self::fetchProductsFromResult($result);
	}

	/**
	 * @throws Exception
	 */
	public static function updateProductStatus(int $id, int $statusId): bool
	{
		$table = 'PRODUCT';

		$data = [
			'ENTITY_STATUS_ID' => $statusId,
		];

		$condition = 'ID = ?';

		return QueryBuilder::update($table, $data, $condition, [$id], true);
	}

	private static function generateSortingOrder(int|null $sortBy): string
	{
		return match ($sortBy)
		{
			1 => "ORDER BY PRICE ASC",
			2 => "ORDER BY PRICE DESC",
			3 => "ORDER BY `TITLE` ASC",
			4 => "ORDER BY `TITLE` DESC",
			default => "ORDER BY `ID`",
		};
	}

	/**
	 * @throws Exception
	 */
	private static function fetchProductsFromResult(
		mysqli_result $result,
		bool          $includeDescription = false,
		bool          $includeBrand = false,
		bool          $includeTags = false,
		bool          $includeStatus = false
	): array
	{
		$products = [];
		while ($row = mysqli_fetch_assoc($result))
		{
			$cover = new Image(null, $row['ID'], $row['PATH'], 1);
			$product = new Product(
				$row['ID'],
				$row['TITLE'],
				$includeDescription ? $row['DESCRIPTION'] : null,
				$row['PRICE'],
				$includeStatus ? $row['ENTITY_STATUS_ID'] : null,
				null,
				null,
				null,
				null,
				$includeBrand ? $row['BRAND'] : null,
				$cover,
				[]
			);
			if ($includeTags)
			{
				$query = "SELECT TAG.ID as tagId, TITLE"
					. " FROM TAG INNER JOIN PRODUCT_TAG"
					. " ON TAG.ID = PRODUCT_TAG.TAG_ID"
					. " WHERE PRODUCT_ID = ?";

				$tags = QueryBuilder::select($query, [$row['ID']], true);

				while ($tagRow = mysqli_fetch_assoc($tags))
				{
					$tag = new Tag($tagRow['tagId'], $tagRow['TITLE'], null);
					$product->addTag($tag);
				}
			}
			$products[] = $product;
		}

		return $products;
	}

	/**
	 * @throws Exception
	 */
	public static function getProductsByIds(?array $ids): array
	{
		if ($ids !== [])
		{
			$placeholder = "(" . implode(",", $ids) . ")";

			$query = "SELECT PRODUCT.ID, TITLE, PRICE, PATH "
				. " FROM PRODUCT"
				. " INNER JOIN IMAGE"
				. " ON PRODUCT.ID = IMAGE.PRODUCT_ID"
				. " WHERE PRODUCT.ID IN $placeholder AND IS_COVER = 1";

			$result = QueryBuilder::select($query);

			return self::fetchProductsFromResult($result);
		}

		return [];
	}
}