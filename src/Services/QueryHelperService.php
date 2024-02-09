<?php

declare(strict_types=1);

namespace Up\Services;

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
				$types .='b';
			}
		}

		return $types;
	}
}