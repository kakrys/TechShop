<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;

class ImageService
{
	private static string $uploadDir = __DIR__ . "/../../../public/assets/images/productImages/";

	public static function insertImageInDatabase(int $productId)
	{
		$connection = DbConnection::get();
		$query = "INSERT INTO IMAGE(`PRODUCT_ID`,`PATH`,`IS_COVER`)" . "VALUES('{$productId}','{$_FILES['image']['name']}',1)";
		if (!$connection->query($query))
		{
			throw new \RuntimeException('Error adding an image: ' . $connection->error);
		}
	}

	public static function insertImageInFolder()
	{
		$filename = $_FILES["image"]["name"];

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if ($ext !== 'png' && $ext !== 'jpg')
		{
			throw new \RuntimeException('Error adding an image: ' . "Недопустимое расширение");
		}
		$target_file = self::$uploadDir . $filename;

		if (move_uploaded_file($_FILES["image"]['tmp_name'], $target_file))
		{
			echo "File is valid, and was successfully uploaded.\n";
		}
	}
}