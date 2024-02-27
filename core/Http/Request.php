<?php

namespace Core\Http;

class Request
{
	public static function server(string $key): string
	{
		return $_SERVER[$key] ?? '';
	}
	private static function filterArray($array):array
	{
		$filteredArray = [];

		foreach ($array as $key=> $arrayElement)
		{

			if(is_array($arrayElement))
			{
				$filteredArray[$key] = self::filterArray($arrayElement);
			}
			else
			{
				$filteredArray[$key] = filter_var($arrayElement, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		return $filteredArray;
	}

	public static function isGet(): string
	{
		return self::server('REQUEST_METHOD') === 'GET';
	}

	public static function isPost(): string
	{
		return self::server('REQUEST_METHOD') === 'POST';
	}

	public static function getBody(): array|null
	{
		$data = [];
		if (self::isGet())
		{
			$data = self::filterArray($_GET);
		}
		if (self::isPost())
		{
			$data = self::filterArray($_POST);
		}
		return $data;
	}
	public static function getSession($key = null): mixed
	{
		if ($key)
		{
			return $_SESSION[$key] ?? null;
		}
		return $_SESSION;
	}
	public static function getFiles(): array|null
	{
		$files = [];
		foreach ($_FILES as $key => $file)
		{
			$files[$key] = [
				'name' => $file['name'],
				'type' => $file['type'],
				'tmp_name' => $file['tmp_name'],
				'error' => $file['error'],
				'size' => $file['size'],
			];
		}
		return $files;
	}
}
