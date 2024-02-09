<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Models\Image;
use Up\Services\SecurityService;

class ImageService
{
	private static string $uploadDir = __DIR__ . "/../../../public/assets/images/productImages/";

	/**
	 * @throws Exception
	 */
	public static function insertImageInDatabase(int $productId, string $filename): void
	{
		$imageData = [
			'PRODUCT_ID' => $productId,
			'PATH' => $filename,
			'IS_COVER' => 1,
		];

		if (!SecurityService::safeInsertQuery('IMAGE', $imageData))
		{
			throw new \RuntimeException('Error adding an image: ' . DbConnection::get()->error);
		}
	}

	public static function insertImageInFolder(string $filename): void
	{

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if ($ext !== 'png' && $ext !== 'jpg')
		{
			throw new \RuntimeException('Error adding an image: ' . "Недопустимое расширение");
		}
		$target_file = self::$uploadDir . $filename;

		if (!move_uploaded_file($_FILES["image"]['tmp_name'], $target_file))
		{
			throw new \RuntimeException('Error adding an image: ' . "Файл не найден");
		}
	}

	public static function renameImage(): string
	{
		$originalFilename = $_FILES["image"]["name"];

		$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);

		return md5(time() . $originalFilename) . "." . $ext;
	}
	public static function deleteImage(int $productId):void
	{
		$connection = DbConnection::get();
		$query="SELECT `PATH`,`PRODUCT_ID` FROM `IMAGE`"
			." WHERE `PRODUCT_ID`=?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param("s", $productId);
		$stmt->execute();
		$result = $stmt->get_result();
		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$image=new Image(null,null,$row['PATH'],null);
			unlink(self::$uploadDir.$image->getPath());
		}

	}
}