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

	public static function getBody(): array|null
	{
		$data = [];
		if (self::method() === 'GET')
		{
			$data=self::filterArray($_GET);
		}
		if (self::method() === 'POST')
		{
			$data=self::filterArray($_POST);
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
