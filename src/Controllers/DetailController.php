<?php

namespace Up\Controllers;

class DetailController extends BaseController
{
	public function detailsAction($id): string
	{
		return "detail page " . $id;
	}
}