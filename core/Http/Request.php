<?php

namespace Core\Http;

class Request
{
	public static function method(): string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function getBody(): array|null
	{
		$data = [];
		if (self::method() === 'GET')
		{
			foreach ($_GET as $key => $value)
			{
				$data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		if (self::method() === 'POST')
		{
			foreach ($_POST as $key => $value)
			{
				$data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		return $data;
	}
	public static function getSession($key = null): array|null
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

//Example How To Use
//$request = Request::getBody();
//var_dump($request['name']);