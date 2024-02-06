<?php

namespace Up\Controllers;

class IndexController extends BaseController
{
	public function indexAction(): string
	{
		$params = [
			'addProducts'=>[9,10],
		];
		return $this->render('main', $params);
	}
}