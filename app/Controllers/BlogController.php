<?php

namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use CodeIgniter\API\ResponseTrait;


class BlogController extends BaseController
{
	use ResponseTrait;

	public function list()
	{
		try {
			$blog = new BlogModel();
			$blogs = $blog->list();
			return $this->getResponse(
				[
					'status' => 200,
					'error' => true,
					'message' => 'ok',
					'data' => json_encode($blogs)
				],
				ResponseInterface::HTTP_CREATED
			);
		} catch (Exception $ex) {
			//throw $th;
			return $this->getResponse(
				[
					'status' => 500,
					'error' => true,
					'message' => $ex->getMessage(),
					'data' => []
				],
				ResponseInterface::HTTP_INTERNAL_SERVER_ERROR
			);
		}
	}
}
