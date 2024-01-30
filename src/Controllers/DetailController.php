<?php

namespace Up\Controllers;

class DetailController extends BaseController
{
	public function detailsAction($id): string
	{
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/detail', [
				'id' => $id
			]),
		]);
	}
}