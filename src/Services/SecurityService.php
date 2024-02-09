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
				else
				{
					$types .= 's';
				}
			}

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

	public static function safeString(string $value): string
	{
		return htmlspecialchars($value, ENT_QUOTES);
	}
}