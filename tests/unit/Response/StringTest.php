<?php

	namespace LiftKit\Tests\Unit\Response;
	
	use LiftKit\Response\String;
	use PHPUnit_Framework_TestCase;
	
	
	class StringTest extends PHPUnit_Framework_TestCase
	{
		protected $response;
		
		
		public function setUp ()
		{
			$this->response = new String('test');
		}
		
		
		public function testToString ()
		{
			$this->assertEquals((string) $this->response, 'test');
		}
	}