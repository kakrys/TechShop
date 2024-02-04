<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;

class ProductService
{
	/**
	 * @throws Exception
	 */
	public static function getProductList($pageNumber): array
	{
		$connection = DbConnection::get();
        $offset = ($pageNumber-1)*9;

		$query = "SELECT `PRODUCT`.`ID`,`TITLE`,`PRICE`,`PATH` from `PRODUCT`"
            ."inner join `IMAGE`"
            ."on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
            ."WHERE `IS_COVER`=1"
            ." LIMIT 9 OFFSET {$offset}";
		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		$products = [];

		while ($row = mysqli_fetch_assoc($result))
		{
            $cover=new \Up\Models\Image(null,$row['ID'],$row['PATH'],1);
			$product = new \Up\Models\Product(
				$row['ID'], $row['TITLE'], null, $row['PRICE'], null,
                null, null, null, null, null,$cover,[]);

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
            ."inner join `IMAGE`"
            ."on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
            ."WHERE PRODUCT.`ID`={$id} and `IS_COVER`= 1";

		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		$row = mysqli_fetch_assoc($result);
        $cover=new \Up\Models\Image(null,$row['ID'],$row['PATH'],1);
		$product = new \Up\Models\Product(
			$row['ID'], $row['TITLE'], $row['DESCRIPTION'], $row['PRICE'], null,
            null, null, null, null, $row['BRAND'],$cover,null
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
            ."inner join `IMAGE`"
            ."on `PRODUCT`.`ID`=`IMAGE`.`PRODUCT_ID`"
            ."WHERE `IS_COVER`=1";;
		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		$products = [];

		while ($row = mysqli_fetch_assoc($result))
		{
            $cover=new \Up\Models\Image(null,$row['ID'],$row['PATH'],1);
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
    public static function addProduct(string $title,string $description,float $price,array $tags,int $brand):void
        {
            $connection = DbConnection::get();
            $query="INSERT INTO `PRODUCT`(`TITLE`,`DESCRIPTION`,`PRICE`,`ENTITY_STATUS_ID`,`SORT_ORDER`,`BRAND_ID`)"
            ."VALUES({$title},{$description},{$price},1,1,{$brand})";
            if (!$connection->query($query))
            {
                throw new \RuntimeException('Error adding an product: ' . $connection->error);
            }
            $idQuery="SELECT LAST_INSERT_ID()";
            $result = mysqli_query($connection, $idQuery);
            $row = mysqli_fetch_assoc($result);
            $product_ID=$row['ID'];
            foreach ($tags as $tag)
            {
                $query="INSERT INTO `PRODUCT_TAG`(`PRODUCT_ID`,`TAG_ID`)"
                    ."VALUES({$product_ID},$tag)";
                if (!$connection->query($query))
                {
                    throw new \RuntimeException('Error adding an product: ' . $connection->error);
                }
            }
        }

}
