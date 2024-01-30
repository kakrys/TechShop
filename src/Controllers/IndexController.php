<?php

namespace Up\Controllers;

class IndexController extends BaseController
{
	public function indexAction(): string
	{

		return $this->render('layout', [
			'page' => $this->render('/pages/main', []),
		]);
	}
}