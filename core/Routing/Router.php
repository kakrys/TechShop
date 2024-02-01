<?php

namespace Core\Routing;

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
	public static function post(string $uri, callable $action): void
	{
		self::add('POST', $uri, $action);
	}

	public static function find(string $method, $uri): ?Route
	{
		[$path] = explode('?', $uri);

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