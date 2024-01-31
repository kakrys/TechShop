<?php

namespace Repository;

use Core\DB\DbConnection;
use Exception;

/**
 * @throws \Exception
 */
function getProductList(): array
{
    $connection = DbConnection::getDbConnection();

    $query = "SELECT `ID`,`TITLE`,`PRICE` from `PRODUCT`";
    $result = mysqli_query($connection, $query);

    if (!$result)
    {
        throw new Exception(mysqli_error($connection));
    }

    $products = [];

    while ($row = mysqli_fetch_assoc($result))
    {
        $product = new \Up\Models\Product(
            $row['ID'], $row['TITLE'], null,
            $row['PRICE'], null,
            null, null, null, null,null
        );

        $products[] = $product;
    }
    return $products;

}

/**
 * @throws \Exception
 */
function getProductInfoByID(int $id): \Up\Models\Product
{
    $connection = DbConnection::getDbConnection();

    $query = "SELECT PRODUCT.`ID`,PRODUCT.`TITLE`,`PRICE`,`DESCRIPTION`,BRAND.`TITLE` as `BRAND`"
        ."from `PRODUCT` INNER JOIN `BRAND` on PRODUCT.BRAND_ID=`BRAND`.`id` "
        ." WHERE PRODUCT.`ID`={$id}";


    $result = mysqli_query($connection, $query);

    if (!$result)
    {
        throw new \RuntimeException(mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);
    $product = new \Up\Models\Product(
        $row['ID'], $row['TITLE'], $row['DESCRIPTION'],
        $row['PRICE'], null,
        null, null, null, null,$row['BRAND']);

    $query = "SELECT `TITLE` from `TAG`inner join `PRODUCT_TAG`"
        ." on `TAG`.ID = `PRODUCT_TAG`.TAG_ID"
        . " WHERE PRODUCT_ID={$id}";

    $tags = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($tags))
    {
        $tag = new \Up\Models\Tag(null, $row['TITLE'], null);
        $product->addTag($tag);

    }
    return $product;
}