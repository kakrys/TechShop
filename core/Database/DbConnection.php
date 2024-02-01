<?php

declare(strict_types=1);

namespace Core\Database;
use Up\Services\ConfigurationService;
use Exception;
use mysqli;

class DbConnection
{
	/**
	 * @return bool|mysqli|null
	 * @throws Exception
	 */
	public static function getDbConnection(): bool|mysqli|null
	{
		static $connection = null;

		if ($connection === null)
		{
			$dbHost = ConfigurationService::option('DB_HOST');
			$dbUser = ConfigurationService::option('DB_USER');
			$dbPassword = ConfigurationService::option('DB_PASSWORD');
			$dbName = ConfigurationService::option('DB_NAME');

			$connection = mysqli_init();

			$connected = mysqli_real_connect($connection, $dbHost, $dbUser, $dbPassword, $dbName);

			if (!$connected)
			{
				$error = mysqli_connect_errno() . ':' . mysqli_connect_error();
				throw new \RuntimeException($error);
			}

			$encodingResult = mysqli_set_charset($connection, 'utf8');

			if (!$encodingResult)
			{
				throw new \RuntimeException(mysqli_error($connection));
			}
		}

		return $connection;
	}
}