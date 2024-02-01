<?php

namespace Up\Controllers;

use function Repository\getProductInfoByID;
use Up\Services\Repository\ProductService;
class DetailController extends BaseController
{
	public function detailsAction($id): string
	{
        $product=ProductService::getProductInfoByID($id);
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/detail', [
				'id' => $id,
                'product'=>$product
			]),
		]);
	}
}