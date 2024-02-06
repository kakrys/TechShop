<?php

declare(strict_types=1);

namespace Up;

use Core\DB\Migrator;
use Core\Routing\Router;
use Exception;

class Application
{
	/**
	 * @throws Exception
	 */
	public function run(): void
	{
		Migrator::executeMigrations();
		$route = Router::find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
		if ($route)
		{
			$action = $route->action;
			$variables = $route->getVariables();

			echo $action(...$variables);
		}
		else
		{
			http_response_code(404);
			echo 'Page not found';
			exit;
		}
	}
}
