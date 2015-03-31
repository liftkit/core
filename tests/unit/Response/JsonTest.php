<?php

	namespace LiftKit\Tests\Unit\Response;

	use LiftKit\Response\Json;
	use PHPUnit_Framework_TestCase;


	class JsonTest extends PHPUnit_Framework_TestCase
	{
		protected $response;


		public function setUp ()
		{
			$this->response = new Json(array('test' => 1));
		}


		public function testToString ()
		{
			$this->assertEquals((string) $this->response, json_encode(array('test' => 1)));
		}


		public function testNestedToString ()
		{
			$response['response'] = $this->response;

			$this->assertEquals(
				json_encode($response),
				json_encode(
					array(
						'response' => array('test' => 1)
					)
				)
			);
		}
	}