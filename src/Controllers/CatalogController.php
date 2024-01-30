<?php

namespace Up\Controllers;

class CatalogController extends BaseController
{
	public function catalogAction($tagName): string
	{

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/catalog', [
				'tag' => $tagName,
				'toolbar' => $this->render('/components/toolbar', []),
				'productList' => $this->render('/components/product-list', []),
			]),
		]);
	}
}