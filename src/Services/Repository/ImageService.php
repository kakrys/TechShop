<?php

namespace Up\Services\Repository;

use Exception;
use RuntimeException;
use Up\Models\Image;
use Core\Http\Request;
use Core\DB\MysqlConnection;
use Core\DB\QueryBuilder;

class ImageService
{
	private static string $uploadDir = __DIR__ . "/../../../public/assets/images/productImages/";

	/**
	 * @throws Exception
	 */
	public static function insertImageInDatabase(int $productId, string $filename, int $isCover): void
	{
		$imageData = [
			'PRODUCT_ID' => $productId,
			'PATH' => $filename,
			'IS_COVER' => $isCover,
		];

		if (!QueryBuilder::insert('IMAGE', $imageData, true))
		{
			throw new RuntimeException('Error adding an image: ' . MysqlConnection::get()->error);
		}
	}

	public static function insertImageInFolder(string $filename): void
	{
		$files = Request::getFiles();

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if ($ext !== 'png' && $ext !== 'jpg')
		{
			throw new RuntimeException('Error adding an image: ' . "Недопустимое расширение");
		}
		$target_file = self::$uploadDir . $filename;

		if (!move_uploaded_file($files["image"]['tmp_name'], $target_file))
		{
			throw new RuntimeException('Error adding an image: ' . "Файл не найден");
		}
	}

	public static function renameImage(): string
	{
		$files = Request::getFiles();

		$originalFilename = $files["image"]["name"];

		$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);

		return md5(time() . $originalFilename) . "." . $ext;
	}

	public static function renameAndSendAddImages(): array
	{
		$files = Request::getFiles();
		$images = $files['images'];
		$size = count($images['name']);
		$imageArray = [];
		if ($images["name"][0] !== "")
		{
			for ($i = 0; $i < $size; $i++)
			{
				//getting section
				$originalFilename = $images["name"][$i];
				$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);
				$newName = md5(time() . $originalFilename) . "." . $ext;
				$imageArray[] = $newName;

				//uploading section
				if ($ext !== 'png' && $ext !== 'jpg')
				{
					throw new RuntimeException('Error adding an additional image: ' . "Недопустимое расширение");
				}
				$target_file = self::$uploadDir . $newName;

				if (!move_uploaded_file($images['tmp_name'][$i], $target_file))
				{
					throw new RuntimeException('Error adding an additional image: ' . "Файл не найден");
				}
			}
		}

		return $imageArray;
	}

	/**
	 * @throws Exception
	 */
	public static function deleteImage(int $productId): void
	{
		$query = "SELECT PATH, PRODUCT_ID FROM IMAGE WHERE PRODUCT_ID = ?";

		$result = QueryBuilder::select($query, [$productId], true);

		while ($row = mysqli_fetch_assoc($result))
		{
			$image = new Image(null, null, $row['PATH'], null);
			unlink(self::$uploadDir . $image->getPath());
		}
	}

	/**
	 * @throws Exception
	 */
	public static function selectProductImages(int $productId): array
	{
		$imageArray = [];
		$query = "SELECT PATH, PRODUCT_ID"
				. " FROM IMAGE WHERE PRODUCT_ID = ?"
				. " AND IS_COVER = 0";

		$result = QueryBuilder::select($query, [$productId], true);
		while ($row = mysqli_fetch_assoc($result))
		{
			$image = new Image(null, null, $row['PATH'], null);
			$imageArray[] = $image;
		}

		return $imageArray;
	}
}