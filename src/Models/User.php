<?php

namespace Up\Models;
use Up\Services\Repository\UserService;

class User
{
	/**
	 * @param int $id
	 * @param string $name
	 * @param string $surname
	 * @param string $email
	 * @param string $password
	 * @param string $address
	 * @param int $roleId
	 * @param int $entityStatusId
	 */
	public function __construct(
		int    $id,
		string $name,
		string $surname,
		string $email,
		string $address,
		int    $roleId = 2,
		int    $entityStatusId = 1,
		string $password = ''
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->password = $password;
		$this->address = $address;
		$this->roleId = $roleId;
		$this->entityStatusId = $entityStatusId;
	}

	readonly int $id;

	readonly string $name;
	readonly string $surname;
	readonly string $email;
	readonly string $password;
	readonly string $address;
	readonly int $roleId;
	readonly int $entityStatusId;

}