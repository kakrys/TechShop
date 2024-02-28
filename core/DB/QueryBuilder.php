<?php

declare(strict_types=1);

namespace Core\DB;

use Exception;
use mysqli_result;
use Up\Services\QueryHelperService;

class QueryBuilder
{
	/**
	 * @throws Exception
	 */
	public static function select(string $query, array $params = null, bool $safe = false): mysqli_result
	{
		return QueryHelperService::executeQuery($query, $params, $safe, true);
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

		return QueryHelperService::executeQuery($query, $values, $safe);
	}

	/**
	 * @throws Exception
	 */
	public static function delete(string $table, string $condition, array $params, bool $safe = false): bool
	{
		$query = "DELETE FROM $table WHERE $condition";

		return QueryHelperService::executeQuery($query, $params, $safe);
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

		return QueryHelperService::executeQuery($query, $values, $safe);
	}
}
