<?php

namespace Up\Services\Repository;

use Core\Http\Request;
use Exception;
use Up\Models\User;
use Up\Services\SecurityService;

class UserService
{
	/**
	 * @param string|null $email
	 *
	 * @return User|null
	 * @throws Exception
	 */
	public static function getUserByEmail(?string $email): ?\Up\Models\User
	{
		if ($email === '')
		{
			return null;
		}

		$query = "SELECT * from USER where EMAIL = ?";

		$result = SecurityService::safeSelectQuery($query, [$email]);

		$row = mysqli_fetch_assoc($result);
		if (!$row)
		{
			return null;
		}

		return new \Up\Models\User(
			$row['ID'],
			$row['NAME'],
			$row['SURNAME'],
			$row['EMAIL'],
			$row['ADDRESS'],
			$row['ROLE_ID'],
			$row['ENTITY_STATUS_ID'],
			$row['PASSWORD'],
		);
	}

	/**
	 * @throws Exception
	 */
	public static function getUserList(): ?array
	{

		$query = "SELECT `ID`, `NAME`, `SURNAME`, `ADDRESS`, `EMAIL` FROM `USER` WHERE `ROLE_ID`= ?";

		$roleID = 2;

		$result = SecurityService::safeSelectQuery($query, [$roleID]);

		$users = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$user = new User(
				$row['ID'], $row['NAME'], $row['SURNAME'], $row['EMAIL'], $row['ADDRESS'],
			);
			$users[] = $user;
		}

		return $users;
	}

	/**
	 * @throws Exception
	 */
	public static function addUser(): bool
	{
		$request = Request::getBody();

		$userName = $request['userName'];
		$userSurname = $request['userSurname'];
		$userEmail = $request['email'];
		$userPassword = $request['password'];
		$userAddress = $request['userAddress'];

		$userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

		$userData = [
			'NAME' => $userName,
			'SURNAME' => $userSurname,
			'EMAIL' => $userEmail,
			'PASSWORD' => $userPassword,
			'ADDRESS' => $userAddress,
			'ROLE_ID' => 2,
			'ENTITY_STATUS_ID' => 1,
		];

		if (!SecurityService::safeInsertQuery('USER', $userData))
		{
			return false;
		}

		return true;
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserName(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		$userNewName = $request['newName'];

		$table = 'USER';
		$data = ['NAME' => $userNewName];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		if (!preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userNewName) || empty(trim($userNewName)))
		{
			return false;
		}

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserSurname(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		$userNewSurname = $request['newSurname'];

		$table = 'USER';
		$data = ['SURNAME' => $userNewSurname];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		if (!preg_match('/^[a-zа-яёA-ZА-ЯЁ]+$/u', $userNewSurname) || empty(trim($userNewSurname)))
		{
			return false;
		}

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserEmail(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		$userNewEmail = $request['newEmail'];

		$table = 'USER';
		$data = ['EMAIL' => $userNewEmail];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		if (
			empty(trim($userNewEmail))
			|| !filter_var($userNewEmail, FILTER_VALIDATE_EMAIL)
			|| self::getUserByEmail($userNewEmail)
		)
		{
			return false;
		}
		$_SESSION['UserEmail'] = $userNewEmail;

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserAddress(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		$userNewAddress = $request['newAddress'];

		$table = 'USER';
		$data = ['ADDRESS' => $userNewAddress];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		if (empty(trim($userNewAddress)))
		{
			return false;
		}

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserPassword(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		$userNewPassword = password_hash($request['newPassword'], PASSWORD_DEFAULT);

		$table = 'USER';
		$data = ['PASSWORD' => $userNewPassword];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		if (empty(trim($userNewPassword)))
		{
			return false;
		}

		return SecurityService::safeUpdateQuery($table, $data, $condition, $params);
	}
}
