<?php

declare(strict_types=1);

namespace Core\DB;

use Exception;
use mysqli_result;
use RuntimeException;
use Up\Services\QueryHelperService;

class QueryBuilder
{
	/**
	 * @throws Exception
	 */
	public static function select(string $query, array $params = null, bool $safe = false): mysqli_result
	{
		if (!empty($params) && $safe)
		{
			$result = QueryHelperService::executePreparedStatement($query, $params, true);
		}
		else
		{
			$connection = MysqlConnection::get();
			$result = mysqli_query($connection, $query);

			if (!$result)
			{
				throw new RuntimeException(mysqli_error($connection));
			}
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function insert(string $table, array $data, bool $safe = false): bool
	{
		$columns = implode(', ', array_keys($data));
		$placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
		$values = array_values($data);

		$query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

		if (!$safe)
		{
			$connection = MysqlConnection::get();
			$result =  mysqli_query($connection, $query);

			if (!$result)
			{
				throw new RuntimeException(mysqli_error($connection));
			}
		}
		else
		{
			$result =  QueryHelperService::executePreparedStatement($query, $values);
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function delete(string $table, string $condition, array $params, bool $safe = false): bool
	{
		$query = "DELETE FROM $table WHERE $condition";

		if (!$safe)
		{
			$connection = MysqlConnection::get();
			$result =  mysqli_query($connection, $query);

			if (!$result)
			{
				throw new RuntimeException(mysqli_error($connection));
			}
		}
		else
		{
			$result =  QueryHelperService::executePreparedStatement($query, $params);
		}

		return $result;
	}

	/**
	 * @throws Exception
	 */
	public static function update(string $table, array $data, string $condition, array $params, bool $safe = false): bool
	{
		$columns = array_keys($data);
		$placeholders = implode(' = ?, ', $columns) . ' = ?';
		$query = "UPDATE $table SET $placeholders WHERE $condition";

		$values = array_merge(array_values($data), $params);

		if (!$safe)
		{
			$connection = MysqlConnection::get();
			$result =  mysqli_query($connection, $query);

			if (!$result)
			{
				throw new RuntimeException(mysqli_error($connection));
			}
		}
		else
		{
			$result =  QueryHelperService::executePreparedStatement($query, $values);
		}

		return $result;
	}
}
