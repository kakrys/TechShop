<?php

namespace Core\DB;

use Exception;
use RuntimeException;

class Migrator
{
	private static string $configPath = __DIR__ . "/../../config/dbtime-config.txt";
	private static string $migrationsPath = __DIR__ . "/../../src/Migrations/";

	private static function getConfigPath(): string
	{
		return self::$configPath;
	}

	private static function getMigrationsPath(): string
	{
		return self::$migrationsPath;
	}

	/**
	 * @throws Exception
	 */
	public static function executeMigrations(): void
	{
		if (!file_exists(self::getConfigPath()))
		{
			$dbConfigFile = fopen(self::getConfigPath(), "wb");

			fwrite($dbConfigFile, 0);
			fclose($dbConfigFile);
		}
		$queries = "";

		$DbTime = file_get_contents(self::getConfigPath());
		$migrationsDir = scandir(self::getMigrationsPath());

		$migrations = array_slice($migrationsDir, 2);
		$connection = MysqlConnection::get();

		foreach ($migrations as $migration)
		{
			$migrationTime = strtotime(substr($migration, 0, -4));

			if ($migrationTime > $DbTime)
			{
				$query = file_get_contents(self::getMigrationsPath() . $migration);

				$queries .= $query;
				file_put_contents(self::getConfigPath(), $migrationTime);

			}
		}
		if (($queries !== "") && !mysqli_multi_query($connection, $queries))
		{
			throw new RuntimeException(mysqli_error($connection));
		}
		while(mysqli_next_result($connection)){;}
	}

	/**
	 * @throws Exception
	 */
	public static function deleteMigrations(): void
	{
		$connection = MysqlConnection::get();
		$dbConfigFile = fopen(self::getConfigPath(), "wb");

		fwrite($dbConfigFile, 0);
		fclose($dbConfigFile);

		$query = file_get_contents(__DIR__ . "/../../uninstall/uninstall-structure.sql");
		if (!mysqli_multi_query($connection, $query))
		{
			throw new RuntimeException(mysqli_error($connection));
		}

	}
}