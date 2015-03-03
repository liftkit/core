<?php


	namespace LiftKit\Tests\Helpers\Router;

	use PHPUnit_Framework_TestCase;
	use LiftKit\Request\Http as HttpRequest;


	class TestCase extends PHPUnit_Framework_TestCase
	{


		protected function createRequest ($method, $uri)
		{
			return new HttpRequest(
				array(
					'REQUEST_METHOD' => $method,
					'REQUEST_URI'    => $uri,
				)
			);
		}
	}