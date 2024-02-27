<?php

declare(strict_types=1);

namespace Up\Services;

use Exception;
use mysqli_result;
use mysqli_stmt;
use Core\DB\MysqlConnection;
use RuntimeException;

class QueryHelperService
{
	private static function getBindTypes(array $params): string
	{
		$types = '';
		foreach ($params as $param)
		{
			$types .= match (gettype($param))
			{
				'integer' => 'i',
				'double' => 'd',
				'string' => 's',
				default => 'b',
			};
		}

		return $types;
	}

	private static function executeStatement(mysqli_stmt $stmt): bool
	{
		$result = $stmt->execute();
		if (!$result)
		{
			throw new RuntimeException($stmt->error);
		}

		return true;
	}

	/**
	 * @throws Exception
	 *
	 */
	private static function executePreparedQuery(
		string $query,
		array  $params,
		bool   $isSelect = false
	): bool|mysqli_result
	{
		$connection = MysqlConnection::get();
		$stmt = $connection->prepare($query);

		if (!$stmt)
		{
			throw new RuntimeException(mysqli_error($connection));
		}

		$types = self::getBindTypes($params);
		$stmt->bind_param($types, ...$params);

		if (!$isSelect)
		{
			return self::executeStatement($stmt);
		}
		self::executeStatement($stmt);

		return $stmt->get_result();

	}

	/**
	 * @throws Exception
	 */
	private static function executeUnpreparedQuery(string $query): bool|mysqli_result
	{
		$connection = MysqlConnection::get();
		$result = mysqli_query($connection, $query);

		if (!$result)
		{
			throw new RuntimeException(mysqli_error($connection));
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function executeQuery(
		string $query,
		array  $params = null,
		bool   $safe = false,
		bool   $isSelect = false
	): mysqli_result|bool
	{
		if (!empty($params) && $safe && $isSelect)
		{
			$result = self::executePreparedQuery($query, $params, $isSelect);
		}
		elseif ($safe && !$isSelect)
		{
			$result = self::executePreparedQuery($query, $params);
		}
		else
		{
			$result = self::executeUnpreparedQuery($query);
		}

		return $result;
	}
}