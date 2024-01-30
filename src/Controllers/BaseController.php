<?php

declare(strict_types=1);

namespace Up\Controllers;

class BaseController
{
	public function render(string $path, array $variables = []): string
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $path))
		{
			throw new \RuntimeException('Invalid template path');
		}
		$absolutePath = ROOT . "/src/Views/default/$path.php";

		if (!file_exists($absolutePath))
		{
			throw new \RuntimeException('Template not found');
		}

		extract($variables);
		ob_start();

		require $absolutePath;

		return ob_get_clean();
	}
}