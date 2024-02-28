<?php

namespace Core\Http;

class Request
{
	public static function method(): string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function uri(): string
	{
		return $_SERVER['REQUEST_URI'];
	}
	private static function filterArray($array):array
	{
		$filteredArray=[];

		foreach ($array as $key=> $arrayElement)
		{

			if(is_array($arrayElement))
			{
				$filteredArray[$key]=self::filterArray($arrayElement);
			}
			else
			{
				$filteredArray[$key]=filter_var($arrayElement, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		return $filteredArray;
	}

	public static function isGet(): string
	{
		return self::method() === 'GET';
	}

	public static function isPost(): string
	{
		return self::method() === 'POST';
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

	public static function unsetSessionValue($key): void
	{
		unset($_SESSION[$key]);
	}
	public static function setSession(string $key, mixed $value):void
	{
		$_SESSION[$key] = $value;
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
