<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Services\PaginationService;

class ProductService
{
	/**
	 * @throws Exception
	 */
	public static function getProductList($pageNumber, $category): array
	{
		$connection = DbConnection::get();
		$offset = ($pageNumber - 1) * 9;

		if ($category === 'all')
		{
			$query = "SELECT `PRODUCT`.`ID`,`TITLE`,`PRICE`,`PATH` FROM `PRODUCT`"
				. "INNER JOIN `IMAGE`"
				. "ON `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
				. "WHERE `IS_COVER`=1"
				. " LIMIT 10 OFFSET {$offset}";
		}
		else
		{

			$query = "SELECT `PRODUCT`.`ID`,`PRODUCT`.`TITLE`,`PRICE`,`PATH` FROM `PRODUCT`"
				. "INNER JOIN `IMAGE`"
				. "ON `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
				. "INNER JOIN `PRODUCT_TAG`"
				. "ON `PRODUCT`.`ID` = `PRODUCT_TAG`.`PRODUCT_ID`"
				. "INNER JOIN `TAG` ON `PRODUCT_TAG`.`TAG_ID`=`TAG`.`ID`"
				. "WHERE `IS_COVER`=1 AND TAG.TITLE='{$category}'"
				. " LIMIT 10 OFFSET {$offset}";
		}
		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

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
		$connection = DbConnection::get();

		$query = "SELECT `PRODUCT`.`ID`,PRODUCT.`TITLE`,`PRICE`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`,`PATH`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE PRODUCT.`ID`={$id} and `IS_COVER`= 1";

		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

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
			. " WHERE PRODUCT_ID={$id}";

		$tags = mysqli_query($connection, $query);

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
		$connection = DbConnection::get();

		$query = "SELECT PRODUCT.`ID`,PRODUCT.`TITLE`,`PRICE`,`PATH`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`"
			. "from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
			. "inner join `IMAGE`"
			. "on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
			. "WHERE `IS_COVER`=1";
		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

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
		var_dump($tags);
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
		$query = "INSERT INTO IMAGE(`PRODUCT_ID`,`PATH`,`IS_COVER`)" . "VALUES('{$product_ID}','undefined.jpg',1)";
		if (!$connection->query($query))
		{
			throw new \RuntimeException('Error adding an product: ' . $connection->error);
		}
	}
}