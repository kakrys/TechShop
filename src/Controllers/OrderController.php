<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Core\Http\Request;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\UserService;

class OrderController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function orderAction($id): string
	{
		session_start();
		$session = Request::getSession();

		if (isset($session['UserEmail']))
		{
			$params = [
				'id' => $id,
				'product' => ProductService::getProductInfoByID((int)$id),
				'user' => UserService::getUserByEmail($session['UserEmail']),
			];

			return $this->render('order', $params);
		}

		$params = [
			'id' => $id,
			'product' => ProductService::getProductInfoByID((int)$id),
		];

		return $this->render('order-unauthorised', $params);

	}

	/**
	 * @throws Exception
	 */
	public function successAction(): string
	{
		session_start();
		$session = Request::getSession();

		if (isset($session['UserEmail']))
		{
			$params = [
				'orderErrors' => OrderService::addOrderOrGetErrors(),
			];

			return $this->render('success', $params);
		}

		$params = [
			'orderErrors' => OrderService::addOrderUnauthorised(),
		];

		return $this->render('success', $params);
	}

}