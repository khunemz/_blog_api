<?php

namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use CodeIgniter\API\ResponseTrait;


class BlogController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		

		try {
			$blog = new BlogModel();
			$blogs = $blog->get_all();

			return $this->getResponse(
				[
					'status' => 201,
					'error' => true,
					'message' => 'created',
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
