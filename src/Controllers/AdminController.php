<?php

declare(strict_types=1);

namespace Up\Controllers;
class AdminController extends BaseController
{
	public function adminAction($id): string
	{
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/admin', [
				'id' => $id,
				'content' => $this->render('/components/admin-list', []),
				'adminEdit' => $this->render('/components/admin-edit', []),
			]),
		]);
	}
}