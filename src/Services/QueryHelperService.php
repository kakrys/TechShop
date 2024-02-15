<?php

declare(strict_types=1);

namespace Up\Services;

use Exception;
use mysqli_result;
use mysqli_stmt;
use Core\DB\DbConnection;
use RuntimeException;

class QueryHelperService
{
	public static function getBindTypes(array $params): string
	{
		$types = '';
		foreach ($params as $param)
		{
			if (is_int($param))
			{
				$types .= 'i';
			}
			elseif (is_float($param))
			{
				$types .= 'd';
			}
			elseif (is_string($param))
			{
				$types .= 's';
			}
			else
			{
				$types .= 'b';
			}
		}

		return $types;
	}

	public static function executeStatement(mysqli_stmt $stmt): bool
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
	public static function executePreparedStatement(
		string $query,
		array  $params,
		bool   $isSelect = false
	): bool|mysqli_result
	{
		$connection = DbConnection::get();
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
		$stmt->execute();

		return $stmt->get_result();

	}
}