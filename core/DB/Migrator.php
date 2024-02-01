<?php

namespace Core\DB;

use Exception;
use Core\DB\DbConnection;
use Up\Services\ConfigurationService;

class Migrator
{
	/**
	 * @throws Exception
	 */
	public static function executeMigrations(): void
	{
		$migrationsDir = scandir(__DIR__ . "/../../src/Migrations");
		$migrations = array_slice($migrationsDir, 2);
		$connection = DbConnection::get();
		foreach ($migrations as $migration)
		{
			$migrationTime = (int)substr($migration, 0, -4);
			if (strtotime($migrationTime) > time())
			{
				$query = file_get_contents(__DIR__ . '/../../src/Migrations/' . $migration);
				if (mysqli_multi_query($connection, $query))
				{
					continue;
				}

				throw new \RuntimeException(mysqli_error($connection));
			}
		}

	}
}