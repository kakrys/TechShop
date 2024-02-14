<?php

declare(strict_types=1);

namespace Core\DB;

use Exception;
use mysqli_result;
use Up\Services\QueryHelperService;

class SafeQueryBuilder
{
	/**
	 * @throws Exception
	 */
	public static function Select(string $query, array $params = null): mysqli_result
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

			if (!$result)
			{
				throw new \RuntimeException(mysqli_error($connection));
			}
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function Insert(string $table, array $data): bool
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
	public static function Delete(string $table, string $condition, array $params): bool
	{
		$query = "DELETE FROM $table WHERE $condition";

		return QueryHelperService::executePreparedStatement($query, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function Update(string $table, array $data, string $condition, array $params): bool
	{
		$columns = array_keys($data);
		$placeholders = implode(' = ?, ', $columns) . ' = ?';
		$query = "UPDATE $table SET $placeholders WHERE $condition";

		$values = array_merge(array_values($data), $params);

		return QueryHelperService::executePreparedStatement($query, $values);
	}
}
