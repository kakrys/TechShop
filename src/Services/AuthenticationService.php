<?php

declare(strict_types=1);

namespace Up\Services;

use Up\Models\User;
use Up\Services\Repository\UserService;
class AuthenticationService
{
	/**
	 * @throws \Exception
	 */
	public static function authenticateUser(?User $user,string $email, string $password, bool $isAdmin = false): bool
	{

		if ($isAdmin) $roleID = 1;
		if (!$isAdmin) $roleID = 2;

		if ($user === null)
		{
			return false;
		}

		return ($user->email === $email && $password === $user->password && $roleID === $user->roleId);
	}

}

