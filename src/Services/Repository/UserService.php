<?php

namespace Up\Services\Repository;

use Exception;
use Up\Models\User;
use RuntimeException;
use Core\Http\Request;
use Core\DB\MysqlConnection;
use Core\DB\QueryBuilder;

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

		$query = "SELECT * FROM USER WHERE EMAIL = ?";

		$result = QueryBuilder::select($query, [$email], true);

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
	public static function getUserList($pageNumber): ?array
	{
		$perPage = 4;
		$offset = ($pageNumber - 1) * $perPage;

		$query = "SELECT ID, NAME, SURNAME, ADDRESS, EMAIL"
			. " FROM USER WHERE ROLE_ID = 2"
			. " LIMIT 5 OFFSET ?";

		$result = QueryBuilder::select($query, [$offset], true);

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
	public static function addUser($userName, $userSurname, $userEmail, $userPassword, $userAddress): bool
	{
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

		if (!QueryBuilder::insert('USER', $userData, true))
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

		return QueryBuilder::update($table, $data, $condition, $params, true);
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

		return QueryBuilder::update($table, $data, $condition, $params, true);
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

		return QueryBuilder::update($table, $data, $condition, $params, true);
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

		return QueryBuilder::update($table, $data, $condition, $params, true);
	}

	/**
	 * @throws Exception
	 */
	public static function updateUserPassword(): bool
	{
		$request = Request::getBody();
		$session = Request::getSession();

		if (empty(trim($request['newPassword'])))
		{
			return false;
		}

		$userNewPassword = password_hash($request['newPassword'], PASSWORD_DEFAULT);

		$table = 'USER';
		$data = ['PASSWORD' => $userNewPassword];
		$condition = 'EMAIL = ?';
		$params = [$session['UserEmail']];

		return QueryBuilder::update($table, $data, $condition, $params, true);
	}

	/**
	 * @throws Exception
	 */
	public static function deleteUserByID(int $id): void
	{
		if (!QueryBuilder::delete('USER', 'USER.ID = ?', [$id], true))
		{
			throw new RuntimeException('Error delete user:  ' . MysqlConnection::get()->error);
		}
	}
}
