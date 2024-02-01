<?php

namespace Up\Controllers;


use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;
class CatalogController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function catalogAction(string $tagName): string
	{
        $products = ProductService::getProductList();
        $tags = TagService::getTagList();

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