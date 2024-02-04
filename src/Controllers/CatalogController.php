<?php

namespace Up\Controllers;

use Exception;
use Up\Services\PaginationService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;

class CatalogController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function catalogAction(string $tagName,$pageNumber): string
	{
        $pageArray=PaginationService::determinePage($pageNumber,$tagName);
		$products = ProductService::getProductList($pageNumber, $tagName);
		$tags = TagService::getTagList();
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/catalog', [
				'tag' => $tagName,
                'pageNumber'=>$pageNumber,
				'toolbar' => $this->render('/components/toolbar', ['tags' => $tags]),
				'productList' => $this->render('/components/product-list', ['products' => $products,
                    'tagName'=>$tagName,'pageArray'=>$pageArray]),
			]),
		]);
	}
}