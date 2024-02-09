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
		if (!empty($params))
		{
			$result = QueryHelperService::executePreparedStatement($query, $params, true);
		}
		else
		{
			$connection = DbConnection::get();
			$escapedQuery = mysqli_real_escape_string($connection, $query);
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
		$columns = implode(', ', array_keys($data));
		$placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
		$values = array_values($data);

		$query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

		return QueryHelperService::executePreparedStatement($query, $values);
	}

	/**
	 * @throws Exception
	 */
	public static function safeDeleteQuery(string $table, string $condition, array $params): bool
	{
		$query = "DELETE FROM $table WHERE $condition";

		return QueryHelperService::executePreparedStatement($query, $params);
	}

	public static function safeString(string $value): string
	{
		return htmlspecialchars($value, ENT_QUOTES);
	}
}