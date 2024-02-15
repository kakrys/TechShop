<?php

namespace Up\Services\Repository;

use Exception;
use mysqli_result;
use RuntimeException;

use Up\Models\Tag;
use Up\Models\Image;
use Up\Models\Product;

use Core\Http\Request;
use Core\DB\DbConnection;
use Core\DB\SafeQueryBuilder;

class ProductService
{
	/**
	 * @throws Exception
	 */
	public static function getProductList(int $pageNumber, string $category, ?array $brands): array
	{
		$perPage = 9;
		$offset = ($pageNumber - 1) * $perPage;
		$brandCondition = $brands !== null ? "AND PRODUCT.BRAND_ID IN (" . implode(",", $brands) . ")" : "";

		if ($category === 'all')
		{
			$query = "SELECT PRODUCT.ID, TITLE, PRICE, PATH FROM PRODUCT "
				. "INNER JOIN IMAGE "
				. "ON PRODUCT.ID = IMAGE.PRODUCT_ID "
				. "WHERE IS_COVER=? $brandCondition LIMIT ? OFFSET ?";

			$params = [1, 10, $offset];
		}
		else
		{
			$query = "SELECT PRODUCT.ID, PRODUCT.TITLE, PRICE, PATH FROM PRODUCT "
				. "INNER JOIN IMAGE "
				. "ON PRODUCT.ID = IMAGE.PRODUCT_ID "
				. "INNER JOIN PRODUCT_TAG "
				. "ON PRODUCT.ID = PRODUCT_TAG.PRODUCT_ID "
				. "INNER JOIN TAG ON PRODUCT_TAG.TAG_ID = TAG.ID "
				. "WHERE IS_COVER=? AND TAG.TITLE=? $brandCondition LIMIT ? OFFSET ?";

			$params = [1, $category, 10, $offset];
		}

		$result = SafeQueryBuilder::Select($query, $params);

		return self::fetchProductsFromResult($result);
	}

	/**
	 * @throws Exception
	 */
	public static function getProductInfoByID(int $id): Product
	{
		$query = "SELECT `PRODUCT`.`ID`,PRODUCT.`TITLE`,`PRICE`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`,`PATH`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE PRODUCT.`ID`=? and `IS_COVER`= ?";

		$params = [$id, 1];

		$result = SafeQueryBuilder::Select($query, $params);

		$row = mysqli_fetch_assoc($result);
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

		$query = "SELECT `TITLE` from `TAG`inner join `PRODUCT_TAG`"
			. " on `TAG`.ID = `PRODUCT_TAG`.TAG_ID"
			. " WHERE PRODUCT_ID=?";

		$tags = SafeQueryBuilder::Select($query, [$id]);

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
		$query = "SELECT PRODUCT.`ID`,PRODUCT.`TITLE`,`PRICE`,`PATH`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE `IS_COVER`=? "
			. "LIMIT ? OFFSET ?";

		$perPage = 9;
		$isCover = 1;
		$limit = 10;
		$offset = ($pageNumber - 1) * $perPage;

		$result = SafeQueryBuilder::Select($query, [$isCover, $limit, $offset]);

		return self::fetchProductsFromResult($result, true, true);
	}

	/**
	 * @throws Exception
	 */
	public static function addProduct(): void
	{
		$request = Request::getBody();
		$title = $request['name'];
		$description = $request["description"];
		$price = $request["price"];
		$tags = $request["tags"];
		$brand = $request["brand"];

		$productData = [
			'TITLE' => $title,
			'DESCRIPTION' => $description,
			'PRICE' => $price,
			'ENTITY_STATUS_ID' => 1,
			'SORT_ORDER' => 1,
			'BRAND_ID' => $brand,
		];

		if (!SafeQueryBuilder::Insert('PRODUCT', $productData))
		{
			throw new RuntimeException('Error adding an product:  ' . DbConnection::get()->error);
		}

		$product_ID = DbConnection::get()->insert_id;

		foreach ($tags as $tagId)
		{
			$productTagData = [
				'PRODUCT_ID' => $product_ID,
				'TAG_ID' => $tagId,
			];
			if (!SafeQueryBuilder::Insert('PRODUCT_TAG', $productTagData))
			{
				throw new RuntimeException('Error adding an product:  ' . DbConnection::get()->error);
			}
		}

		$imageName = ImageService::renameImage();
		ImageService::insertImageInFolder($imageName);
		ImageService::insertImageInDatabase($product_ID, $imageName);
	}

	/**
	 * @throws Exception
	 */
	public static function getProductsByTitle(
		$pageNumber,
		?string $productTitle,
		?string $category = null,
		?array $brands = null
	): array
	{
		$offset = ($pageNumber - 1) * 9;
		$brandCondition = $brands !== null ? "AND PRODUCT.BRAND_ID IN (" . implode(",", $brands) . ")" : "";

		if ($category === 'all')
		{
			$query = "SELECT TITLE, PRODUCT.ID,PRICE, DESCRIPTION, PATH FROM PRODUCT "
				. "INNER JOIN IMAGE "
				. "ON PRODUCT.ID=IMAGE.PRODUCT_ID "
				. "WHERE TITLE LIKE ? AND IS_COVER=? $brandCondition LIMIT ? OFFSET ?";

			$params = ["%$productTitle%", 1, 10, $offset];
		}
		else
		{
			$query = "SELECT PRODUCT.TITLE, PRODUCT.ID,PRICE, DESCRIPTION, PATH FROM PRODUCT "
				. "INNER JOIN IMAGE "
				. "ON PRODUCT.ID=IMAGE.PRODUCT_ID "
				. "INNER JOIN PRODUCT_TAG "
				. "ON PRODUCT.ID = PRODUCT_TAG.PRODUCT_ID "
				. "INNER JOIN TAG ON PRODUCT_TAG.TAG_ID = TAG.ID "
				. "WHERE PRODUCT.TITLE LIKE ? AND IS_COVER=? "
				. "AND TAG.TITLE=? $brandCondition LIMIT ? OFFSET ?";

			$params = ["%$productTitle%", 1, $category, 10, $offset];
		}

		$result = SafeQueryBuilder::Select($query, $params);

		return self::fetchProductsFromResult($result, true);
	}

	/**
	 * @throws Exception
	 */
	public static function updateProductByID(int $id, string $title, float $price, string $description): bool
	{
		$table = 'PRODUCT';
		$data = [
			'TITLE' => $title,
			'DESCRIPTION' => $description,
			'PRICE' => $price,
			'DATE_UPDATE' => date('Y-m-d H:i:s'),
		];
		$condition = '`ID` = ?';
		$params = [$id];

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function deleteProductByID(int $id): void
	{
		ImageService::deleteImage($id);

		// Удаление изображений
		if (!SafeQueryBuilder::Delete('`IMAGE`', '`IMAGE`.`PRODUCT_ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete image:  ' . DbConnection::get()->error);
		}

		// Удаление тегов
		if (!SafeQueryBuilder::Delete('`PRODUCT_TAG`', '`PRODUCT_TAG`.`PRODUCT_ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete product_tag:  ' . DbConnection::get()->error);
		}

		// Удаление продукта
		if (!SafeQueryBuilder::Delete('`PRODUCT`', '`PRODUCT`.`ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete product:  ' . DbConnection::get()->error);
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
			. " WHERE IS_COVER=?"
			. " ORDER BY DATE_RELEASE DESC"
			. " LIMIT ?";

		$params = [1, 5];

		$result = SafeQueryBuilder::Select($query, $params);

		return self::fetchProductsFromResult($result);
	}

	private static function fetchProductsFromResult(
		mysqli_result $result,
		bool          $includeDescription = false,
		bool          $includeBrand = false
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
				null,
				null,
				null,
				null,
				null,
				$includeBrand ? $row['BRAND'] : null,
				$cover,
				[]
			);
			$products[] = $product;
		}

		return $products;
	}
}