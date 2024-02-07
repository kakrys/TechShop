<?php

namespace Up\Services\Repository;

use Core\DB\DbConnection;
use Exception;
use Up\Models\User;

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
		$connection = DbConnection::get();

		$query = "SELECT * from USER where EMAIL = '{$email}'";

		$result = mysqli_query($connection, $query);


		if (!$result)
		{
			throw new \RuntimeException(mysqli_error($connection));
		}
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
		$connection = DbConnection::get();

		$query = "SELECT `ID`, `NAME`, `SURNAME`, `ADDRESS`, `EMAIL` FROM `USER` WHERE `ROLE_ID`=2";

		$result = mysqli_query($connection, $query);

		if (!$result) {
			throw new \RuntimeException(mysqli_error($connection));
		}

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

	public static function addUser():bool
	{
		$userName=$_POST['userName'];
		$userSurname = $_POST['userSurname'];
		$userEmail = $_POST['email'];
		$userPassword = $_POST['password'];
		$userAddress = $_POST['userAddress'];
		$connection = DbConnection::get();
		$userPassword = password_hash($userPassword,PASSWORD_DEFAULT);
		$userAddQuery = "INSERT INTO `USER` (`NAME`, `SURNAME`, `EMAIL`, `PASSWORD`,`ADDRESS`,`ROLE_ID`, `ENTITY_STATUS_ID`)"
			. " VALUES ('{$userName}', '{$userSurname}','{$userEmail}','{$userPassword}','{$userAddress}',2, 1)";
		if (!$connection->query($userAddQuery))
		{
			return false;
		}
		return true;
	}
}
