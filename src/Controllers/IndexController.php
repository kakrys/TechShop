<?php

namespace Up\Controllers;

class IndexController extends BaseController
{
	public function indexAction(): string
	{

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/main', [
				'toolbar' => $this->render('/components/toolbar', [])
			]),
		]);
	}
}