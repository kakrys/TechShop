<?php
use Core\DB\DbConnection;
function mainPage($limit,$page)
{
    $connection=DbConnection::getDbConnection();

    $result=mysqli_query($connection,"SELECT * from `PRODUCT`
    ");
    if (!$result)
    {
        throw new Exception(mysqli_error($connection));
    }
    $products=[];
    while($row=mysqli_fetch_assoc($result))
    {
        $product=new \Up\Models\Product(
            $row['id'],$row['title'],null,
            $row['price'],$row['statusId'],
            null,null,null,null
        );
    }
    var_dump($products);

}
mainPage(null,null);