<?php

declare(strict_types=1);

namespace Up\Services;

use RuntimeException;

class ConfigurationService
{
	public static function option(string $name, mixed $defaultValue = null):mixed
	{
		/**@var array $config */
		static $config = null;

		if ($config === null)
		{
			$masterConfig = require_once ROOT . '/config/config.php';
			if (file_exists(ROOT . '/config/local-config.php'))
			{
				$localConfig = require_once ROOT . '/config/local-config.php';
			}
			else
			{
				$localConfig = [];
			}

			$config = array_merge($masterConfig, $localConfig);
		}

		if (array_key_exists($name, $config))
		{
			return $config[$name];
		}

		if ($defaultValue !== null)
		{
			return $defaultValue;
		}

		throw new RuntimeException("Configuration option $name not found");
	}
}
