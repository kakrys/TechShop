<?php

declare(strict_types=1);

namespace Up;

use Core\DB\Migrator;
use Core\Routing\Router;
use Exception;
use Core\Http\Request;

class Application
{
	/**
	 * @throws Exception
	 */
	public function run(): void
	{
		Migrator::executeMigrations();
		$route = Router::find(Request::server('REQUEST_METHOD'), Request::server('REQUEST_URI'));
		if ($route)
		{
			$action = $route->action;
			$variables = $route->getVariables();
			echo $action(...$variables);
		}
		else
		{
			http_response_code(404);
			require_once "Views/default/pages/_404.php";
			exit;
		}
	}
}
