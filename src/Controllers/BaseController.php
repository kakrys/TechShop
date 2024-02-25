<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use RuntimeException;

class BaseController
{
	protected function renderView($view, $params): string|Exception
	{
		$absolutePath = $this->getViewPath($view);
		if (!file_exists($absolutePath))
		{
			throw new RuntimeException("Layout content '$view' not found.");
		}

		extract($params);
		ob_start();
		include_once $absolutePath;

		return ob_get_clean();
	}

	protected function getViewPath($view): string|Exception
	{
		$viewPath = ROOT . "/src/Views/default/pages/$view.php";
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $view))
		{
			throw new RuntimeException('Invalid template path');
		}

		return $viewPath;
	}

	public function render($view, $params = []): string
	{
		$layoutContent = $this->setLayout();
		$viewContent = $this->renderView($view, $params);

		return str_replace('{{content}}', $viewContent, $layoutContent);
	}

	public function get404(): string
	{
		ob_start();
		http_response_code(404);
		require_once __DIR__ . "/../Views/default/pages/_404.php";

		return ob_get_clean();
	}

	protected function setLayout(): bool|string
	{
		ob_start();
		include_once ROOT . "/src/Views/default/layout.php";

		return ob_get_clean();
	}

	protected function renderComponent($component, $params = []): string|Exception
	{
		$componentPath = $this->getComponentPath($component);
		if (!file_exists($componentPath))
		{
			throw new RuntimeException("Component '$component' not found.");
		}

		extract($params);
		ob_start();
		include_once $componentPath;

		return ob_get_clean();
	}

	protected function getComponentPath($component): string|Exception
	{
		$componentPath = ROOT . "/src/Views/default/components/$component.php";
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $component))
		{
			throw new RuntimeException('Invalid template path');
		}

		return $componentPath;
	}
}