<?php

namespace Core\Routing;

use Core\Routing\Route;

class Router
{
	/**
	 * @var Route[]
	 */
	public static array $routes = [];

	public static function add(string $method, string $uri, callable $action): void
	{
		self::$routes[] = new Route($method, $uri, \Closure::fromCallable($action));
	}

	public static function get(string $uri, callable $action): void
	{
		self::add('GET', $uri, $action);
	}

	public static function find(string $method, $uri): ?Route
	{
		[$path] = explode('?', $uri);
		var_dump($path);

		foreach (self::$routes as $route)
		{
			if ($route->method !== $method) continue;

			if ($route->match($path))
			{
				return $route;
			}
		}
		return null;
	}
}