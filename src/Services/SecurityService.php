<?php

declare(strict_types=1);

namespace Up\Services;

use Exception;
use mysqli_result;
use Core\DB\DbConnection;

class SecurityService
{
	/**
	 * @throws Exception
	 */
	public static function safeSelectQuery(string $query, array $params = null): mysqli_result
	{
		$connection = DbConnection::get();
		$escapedQuery = mysqli_real_escape_string($connection, $query);

		if (!empty($params))
		{
			$stmt = $connection->prepare($query);
			$types = QueryHelperService::getBindTypes($params);

			$stmt->bind_param($types, ...$params);
			$stmt->execute();
			$result = $stmt->get_result();
		}
		else
		{
			$result = mysqli_query($connection, $escapedQuery);
		}

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function safeInsertQuery(string $table, array $data): bool
	{
		$connection = DbConnection::get();

		$columns = implode(', ', array_keys($data));
		$placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
		$values = array_values($data);

		$query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
		$stmt = $connection->prepare($query);

		if (!$stmt)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		$types = QueryHelperService::getBindTypes($values);

		$stmt->bind_param($types, ...$values);
		$result = $stmt->execute();

		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}

		return true;
	}

	public static function safeString(string $value): string
	{
		return htmlspecialchars($value, ENT_QUOTES);
	}
}