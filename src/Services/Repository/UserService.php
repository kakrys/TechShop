<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\User;
use RuntimeException;
use Core\Http\Request;
use Core\DB\DbConnection;
use Core\DB\SafeQueryBuilder;

class UserService
{
	/**
	 * @param string|null $email
	 *
	 * @return User|null
	 * @throws Exception
	 */
	public static function getUserByEmail(?string $email): ?User
	{
		if ($email === '')
		{
			return null;
		}

		$query = "SELECT * from USER where EMAIL = ?";

		$result = SafeQueryBuilder::Select($query, [$email]);

		$row = mysqli_fetch_assoc($result);
		if (!$row)
		{
			return null;
		}

		return new User(
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

		$result = SafeQueryBuilder::Select($query, [$roleID]);

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

		if (!SafeQueryBuilder::Insert('USER', $userData))
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

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
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

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
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

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
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

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
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

		return SafeQueryBuilder::Update($table, $data, $condition, $params);
	}

	/**
	 * @throws Exception
	 */
	public static function deleteUserByID(int $id): void
	{
		if (!SafeQueryBuilder::Delete('`USER`', '`USER`.`ID` = ?', [$id]))
		{
			throw new RuntimeException('Error delete user:  ' . DbConnection::get()->error);
		}
	}
}
