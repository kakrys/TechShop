<?php

declare(strict_types=1);

namespace Up\Services;

class SecurityService
{
	public static function safeString(string $value): string
	{
		return htmlspecialchars($value, ENT_QUOTES);
	}
}