<?php

declare(strict_types=1);

namespace Up\Controllers;
class OrderController extends BaseController
{
	public function orderAction($id): string
	{
		return $this->render('layout', [
			'page' => $this->render('/pages/order', [
				'id' => $id
			]),
		]);
	}
}