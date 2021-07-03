<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
class BaseController extends Controller
{
	protected $request;

	protected $helpers = ['form','url'];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
	}

	protected function getRequestInput(IncomingRequest $request)
	{
		$input = $request->getPost();
		if (empty($input)) {
			$input = json_decode($request->getBody(), true);
		}
		return $input;
	}

	protected function getResponse(
		array $responseBody,
		int $code = ResponseInterface::HTTP_OK
	) {
		return $this
			->response
			->setStatusCode($code)
			->setJSON($responseBody);
	}

	protected function validateRequest($input, array $rules, array $messages = [])
	{
		$this->validator = Services::Validation()->setRules($rules);
		if (is_string($rules)) {
			$validation = config('Validation');
			if (!isset($validation->$rules)) {
				throw ValidationException::forRuleNotFound($rules);
			}
			if (!$messages) {
				$errorName = $rules . '_errors';
				$messages = $validation->$errorName ?? [];
			}

			$rules = $validation->$rules;
		}
		return $this->validator->setRules($rules, $messages)->run($input);
	}
}