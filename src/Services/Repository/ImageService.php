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
	private static function getImageArray($arrayName):array
	{
		return Request::getFiles()[$arrayName];
	}


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
		//$files = Request::getFiles();
		$target_file = self::$uploadDir . $filename;

		if (!move_uploaded_file(self::getImageArray('image')['tmp_name'], $target_file))
		{
			throw new RuntimeException('Error adding an image: ' . "Файл не найден");
		}
	}
	public static function checkIfImage():bool
	{
		$maxFileSize=40 * 1024 * 1024;
		if ($_SERVER['CONTENT_LENGTH'] > $maxFileSize)
		{
			throw new RuntimeException('File too big');
		}
		$image=self::getImageArray('image');
		$images = self::getImageArray('images');
		$size = count($images['name']);
		if(!getimagesize( $image['tmp_name']))
		{
			throw new RuntimeException('Invalid main image');
		}
		if ($images["name"][0] !== "")
		{
			for ($i = 0; $i < $size; $i++)
			{
				if (!getimagesize($images['tmp_name'][$i]))
				{
					throw new RuntimeException('Invalid additional image');
				}
			}
		}
		return true;
	}
	public static function renameImage(): string
	{
		$image=self::getImageArray('image');

		$originalFilename = $image["name"];

		$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);

		return md5(time() . $originalFilename) . "." . $ext;
	}

	public static function renameAndSendAddImages(): array
	{
		$image = self::getImageArray('image');
		$images = self::getImageArray('images');
		$size = count($images['name']);
		$imageArray = [];
		if ($images["name"][0] !== "")
		{
			for ($i = 0; $i < $size; $i++)
			{
				$originalFilename = $images["name"][$i];
				$ext = pathinfo($originalFilename, PATHINFO_EXTENSION);
				$newName = md5(time() . $originalFilename) . "." . $ext;
				$imageArray[] = $newName;
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