<?php
namespace Up\Services;
class PaginationService
{
    public static function updateCategory(string $category):void
    {
        $json_arr=json_decode(file_get_contents("../config/product-count.json"),true);
        $json_arr[$category] = ++$json_arr[$category];
        $json = json_encode($json_arr);
        file_put_contents("../config/productCount.json", $json);
    }
    public static function getCategory(string $category):int
    {
        $json_arr=json_decode(file_get_contents("../config/product-count.json"),true);
        return (int)$json_arr[$category];
    }
    public static function determinePage(int $pageNumber,$tagName):array
    {
        $maxPageNumber=intdiv(self::getCategory($tagName),9)+1;
        $pageArray=[];
        if ($pageNumber==1)
        {
            $prevPage=1;
        }
        else
        {
            $prevPage=$pageNumber-1;
        }

        if ($pageNumber<$maxPageNumber)
        {
            $nextPage=$pageNumber+1;
        }
        else
        {
            $nextPage=$pageNumber;
        }
        $pageArray[]=$prevPage;
        $pageArray[]=$nextPage;
        return($pageArray);
    }
}
