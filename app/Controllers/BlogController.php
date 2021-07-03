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
			return $this->getResponse($blogs,
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

	public function save()
	{
		try {
			$title = $this->request->getVar('title');
			$description = $this->request->getVar('description');
			$slug = $this->request->getVar('slug');
			$data = [
				'title' => $title,
				'descript' => $description,
				'slug' => $slug ? $slug : ''
			];
			$blog = new BlogModel();
			$id = $blog->insert($data, true);
			return $this->getResponse(
				[
					'status' => 201,
					'error' => false,
					'message' => 'ok',
					'data' => json_encode([
						'id' => $id
					])
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

	public function update($id)
	{
		try {
			$title = $this->request->getVar('title');
			$description = $this->request->getVar('description');
			$slug = $this->request->getVar('slug');
			$data = [
				'title' => $title,
				'descript' => $description,
				'slug' => $slug ? $slug : ''
			];
			$blog = new BlogModel();
			$row = $blog->findById($id);
			if ($row > 0) {
				$updated_success = $blog->update($id, $data);
				if ($updated_success) {
					return $this->getResponse(
						[
							'status' => 201,
							'error' => false,
							'message' => 'ok',
							'data' => json_encode(['success' => $updated_success])
						],
						ResponseInterface::HTTP_OK
					);
				} else {
					return $this->getResponse(
						[
							'status' => 304,
							'error' => true,
							'message' => 'fail, upate not successfully',
							'data' => json_encode(['success' => $updated_success])
						],
						ResponseInterface::HTTP_NOT_MODIFIED
					);
				}
			} else {
				return $this->getResponse(
					[
						'status' => 404,
						'error' => true,
						'message' => 'fail no record for $id: ' . $id,
						'data' => json_encode(['success' => false])
					],
					ResponseInterface::HTTP_NOT_FOUND
				);
			}
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

	public function delete($id)
	{
		try {
			$blog = new BlogModel();
			$row = $blog->findById($id);
			if ($row > 0) {
				$is_success = $blog->delete($id);
				if ($is_success) {
					return $this->getResponse(
						[
							'status' => 201,
							'error' => false,
							'message' => 'ok',
							'data' => json_encode(['success' => $is_success])
						],
						ResponseInterface::HTTP_OK
					);
				} else {
					return $this->getResponse(
						[
							'status' => 500,
							'error' => true,
							'message' => 'fail, unexpect error occured',
							'data' => json_encode(['success' => $is_success])
						],
						ResponseInterface::HTTP_INTERNAL_SERVER_ERROR
					);
				}
			} else {
				return $this->getResponse(
					[
						'status' => 404,
						'error' => true,
						'message' => 'fail no record for $id: ' . $id,
						'data' => json_encode(['success' => false])
					],
					ResponseInterface::HTTP_NOT_FOUND
				);
			}
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
