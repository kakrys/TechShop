<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
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

		while ($row = mysqli_fetch_assoc($result)) {
			$user = new User(
				$row['ID'],
				$row['NAME'],
				$row['SURNAME'],
				$row['EMAIL'],
				$row['ADDRESS'],
			);
			$users[] = $user;
		}

		return $users;
	}

	/**
	 * @throws Exception
	 */
	public static function addUser():bool
	{
		$userName = $_POST['userName'];
		$userSurname = $_POST['userSurname'];
		$userEmail = $_POST['email'];
		$userPassword = $_POST['password'];
		$userAddress = $_POST['userAddress'];

		$userPassword = password_hash($userPassword,PASSWORD_DEFAULT);

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

	public static function updateUserName():bool
	{
		$userNewName=$_POST['newName'];
		$connection = DbConnection::get();
		$query = "UPDATE USER SET NAME = '{$userNewName}' where EMAIL = '{$_SESSION['UserEmail']}'";
		if (!$connection->query($query))
		{
			return false;
		}
		return true;
	}

	public static function updateUserSurname():bool
	{
		$userNewSurname=$_POST['newSurname'];
		$connection = DbConnection::get();
		$query = "UPDATE USER SET SURNAME = '{$userNewSurname}' where EMAIL = '{$_SESSION['UserEmail']}'";
		if (!$connection->query($query))
		{
			return false;
		}
		return true;
	}

	public static function updateUserEmail():bool
	{
		$userNewEmail=$_POST['newEmail'];
		$connection = DbConnection::get();
		$query = "UPDATE USER SET EMAIL = '{$userNewEmail}' where EMAIL = '{$_SESSION['UserEmail']}'";
		if (!$connection->query($query))
		{
			return false;
		}
		$_SESSION['UserEmail'] = $userNewEmail;
		return true;
	}

	public static function updateUserAddress():bool
	{
		$userNewAddress = $_POST['newAddress'];
		$connection = DbConnection::get();
		$query = "UPDATE USER SET ADDRESS = '{$userNewAddress}' where EMAIL = '{$_SESSION['UserEmail']}'";
		if (!$connection->query($query))
		{
			return false;
		}
		return true;
	}

	public static function updateUserPassword():bool
	{
		$userNewPassword = password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
		$connection = DbConnection::get();
		$query = "UPDATE USER SET PASSWORD = '{$userNewPassword}' where EMAIL = '{$_SESSION['UserEmail']}'";
		if (!$connection->query($query))
		{
			return false;
		}
		return true;
	}
}
