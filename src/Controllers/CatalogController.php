<?php

namespace Up\Controllers;

use function Repository\getProductList;
use function Repository\getTagList;

class CatalogController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function catalogAction(string $tagName): string
	{
        $products = getProductList();
        $tags = getTagList();

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/catalog', [
				'tag' => $tagName,
				'toolbar' => $this->render('/components/toolbar', ['tags'=>$tags]),
				'productList' => $this->render('/components/product-list', ['products'=>$products]),
			]),
		]);
	}
}