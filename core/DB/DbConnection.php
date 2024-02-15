<?php

declare(strict_types=1);

namespace Core\DB;

use mysqli;
use Exception;
use RuntimeException;
use Up\Services\ConfigurationService;

class DbConnection
{
	private static ?mysqli $instance = null;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	public function __wakeup()
	{
		throw new RuntimeException("Cannot unserialize singleton");
	}

	/**
	 * @return mysqli
	 * @throws Exception
	 */
	public static function get(): mysqli
	{
		if (self::$instance === null)
		{
			self::$instance = self::createConnection();
		}

		return self::$instance;
	}

	/**
	 * @return mysqli
	 * @throws Exception
	 */
	private static function createConnection(): mysqli
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
			throw new RuntimeException($error);
		}

		$encodingResult = mysqli_set_charset($connection, 'utf8');

		if (!$encodingResult)
		{
			throw new RuntimeException(mysqli_error($connection));
		}

		return $connection;
	}
}