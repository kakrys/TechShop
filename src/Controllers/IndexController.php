<?php

namespace Up\Controllers;

class IndexController extends BaseController
{
	public function indexAction($tagName): string
	{

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/main', [
				'tag' => $tagName,
				'toolbar' => $this->render('/components/toolbar', [])
			]),
		]);
	}
}