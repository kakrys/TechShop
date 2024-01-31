<?php

namespace Up\Controllers;

use function Repository\getProductInfoByID;
class DetailController extends BaseController
{
	public function detailsAction($id): string
	{
        $product=getProductInfoByID($id);
		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/detail', [
				'id' => $id,
                'product'=>$product
			]),
		]);
	}
}