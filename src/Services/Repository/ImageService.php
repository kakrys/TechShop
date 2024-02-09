<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Core\Http\Request;
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
		$files = Request::getFiles();

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if ($ext !== 'png' && $ext !== 'jpg')
		{
			throw new \RuntimeException('Error adding an image: ' . "Недопустимое расширение");
		}
		$target_file = self::$uploadDir . $filename;

		if (!move_uploaded_file($files["image"]['tmp_name'], $target_file))
		{
			throw new \RuntimeException('Error adding an image: ' . "Файл не найден");
		}
	}

	public static function renameImage(): string
	{
		$files = Request::getFiles();

		$originalFilename = $files["image"]["name"];

		$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);

		return md5(time() . $originalFilename) . "." . $ext;
	}

	/**
	 * @throws Exception
	 */
	public static function deleteImage(int $productId): void
	{
		$query = "SELECT `PATH`,`PRODUCT_ID` FROM `IMAGE` WHERE `PRODUCT_ID`=?";

		$result = SecurityService::safeSelectQuery($query, [$productId]);

		while ($row = mysqli_fetch_assoc($result))
		{
			$image = new Image(null, null, $row['PATH'], null);
			unlink(self::$uploadDir . $image->getPath());
		}

	}
}