<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Response;

class APIController extends Controller
{
 	private $statusCode = 200;

	
	public function setStatusCode($statusCode) 
	{
		$this->statusCode = $statusCode;
		
		return $this; 
	}   

	public function getStatusCode() 
	{
		return $this->statusCode;
	}

	public function respondNotFound($message = 'Not found.') 
	{
		$this->setStatusCode(404)->responseWithError($message);
	}

	public function respondInternalError($message = 'Internal Error.') 
	{
		$this->setStatusCode(500)->responseWithError($message);
	}	

	public function respond($data, $headers = []) 
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function responseWithError($message) 
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}
}