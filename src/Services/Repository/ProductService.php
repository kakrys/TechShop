<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Services\PaginationService;
use Up\Services\SecurityService;

class ProductService
{
	/**
	 * @throws Exception
	 */
	public static function getProductList(int $pageNumber, string $category): array
	{
		$perPage = 9;
		$offset = ($pageNumber - 1) * $perPage;

		if ($category === 'all')
		{
			$query = "SELECT PRODUCT.ID, TITLE, PRICE, PATH FROM PRODUCT "
				. "INNER JOIN IMAGE "
				. "ON PRODUCT.ID = IMAGE.PRODUCT_ID "
				. "WHERE IS_COVER=? "
				. "LIMIT ? OFFSET ?";

			$bindValue = 'iii';
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
				. "WHERE IS_COVER=? AND TAG.TITLE=? "
				. "LIMIT ? OFFSET ?";

			$bindValue = 'isii';
			$params = [1, $category, 10, $offset];
		}

		$result = SecurityService::safeSelectQuery($query, $params, $bindValue);

		$products = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$cover = new \Up\Models\Image(null, $row['ID'], $row['PATH'], 1);
			$product = new \Up\Models\Product(
				$row['ID'], $row['TITLE'],
				null, $row['PRICE'],
				null, null,
				null, null,
				null, null,
				$cover, []
			);

			$products[] = $product;
		}

		return $products;

	}

	/**
	 * @throws Exception
	 */
	public static function getProductInfoByID(int $id): \Up\Models\Product
	{
		$query = "SELECT `PRODUCT`.`ID`,PRODUCT.`TITLE`,`PRICE`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`,`PATH`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE PRODUCT.`ID`=? and `IS_COVER`= ?";

		$bindValue = 'ii';
		$params = [$id, 1];

		$result = SecurityService::safeSelectQuery($query, $params, $bindValue);

		$row = mysqli_fetch_assoc($result);
		$cover = new \Up\Models\Image(null, $row['ID'], $row['PATH'], 1);
		$product = new \Up\Models\Product(
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

		$tags = SecurityService::safeSelectQuery($query, [$id], 'i');

		while ($row = mysqli_fetch_assoc($tags))
		{
			$tag = new \Up\Models\Tag(null, $row['TITLE'], null);
			$product->addTag($tag);

		}

		return $product;
	}

	/**
	 * @throws Exception
	 */
	public static function getProductListForAdmin(): array
	{
		$query = "SELECT PRODUCT.`ID`,PRODUCT.`TITLE`,`PRICE`,`PATH`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE `IS_COVER`=?";

		$result = SecurityService::safeSelectQuery($query, [1], 'i');

		$products = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$cover = new \Up\Models\Image(null, $row['ID'], $row['PATH'], 1);
			$product = new \Up\Models\Product(
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

			$products[] = $product;
		}

		return $products;

	}

	/**
	 * @throws Exception
	 */
	public static function addProduct(): void
	{
		$title = $_POST['name'];
		$description = $_POST["description"];
		$price = $_POST["price"];
		$tags = $_POST["tags"];
		$brand = $_POST["brand"];
		$connection = DbConnection::get();

		$query = "INSERT INTO `PRODUCT`(`TITLE`,`DESCRIPTION`,`PRICE`,`ENTITY_STATUS_ID`,`SORT_ORDER`,`BRAND_ID`)"
			. " VALUES('{$title}','{$description}','{$price}',1,1,'{$brand}')";

		if (!$connection->query($query))
		{
			throw new \RuntimeException('Error adding an product: ' . $connection->error);
		}

		$product_ID = $connection->insert_id;
		foreach ($tags as $tagId)
		{
			$query = "INSERT INTO `PRODUCT_TAG`(`PRODUCT_ID`,`TAG_ID`)" . " VALUES ({$product_ID},$tagId)";

			if (!$connection->query($query))
			{
				throw new \RuntimeException('Error adding an product: ' . $connection->error);
			}
		}
		ImageService::insertImageInFolder(ImageService::renameImage());
		ImageService::insertImageInDatabase($product_ID, ImageService::renameImage());
	}

	/**
	 * @throws Exception
	 */
	public static function getProductsByTitle($pageNumber, $productTitle): array
	{
		$offset = ($pageNumber - 1) * 9;

		$query = "SELECT `TITLE`, `PRODUCT`.`ID`,`PRICE`, DESCRIPTION, `PATH` FROM `PRODUCT` "
			."INNER JOIN `IMAGE`"
			. "ON `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. " WHERE `TITLE` LIKE ? AND `IS_COVER`=?"
			." LIMIT ? OFFSET ?";

		$params = ["%{$productTitle}%", 1, 10, $offset];

		$result = SecurityService::safeSelectQuery($query, $params, 'siii');

		$products = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$cover = new \Up\Models\Image(null, $row['ID'], $row['PATH'], 1);
			$product = new \Up\Models\Product(
				$row['ID'],
				$row['TITLE'],
				$row['DESCRIPTION'],
				$row['PRICE'],
				null, null,
				null, null,
				null, null,
				$cover, []
			);

			$products[] = $product;
		}

		return $products;
	}
}