<?php

	namespace LiftKit\Tests\Unit\Response;
	
	use LiftKit\Response\View;
	use PHPUnit_Framework_TestCase;
	
	
	class ViewTest extends PHPUnit_Framework_TestCase
	{
		protected $response;
		
		
		public function setUp ()
		{
			$this->response = new View(__DIR__ . '/../../views/test.php', array('message' => 'test'));
		}
		
		
		public function testToString ()
		{
			$this->assertEquals((string) $this->response, 'test');
		}
		
		
		public function setData ()
		{
			$this->response->setData('message', 'test1');
			
			$this->assertEquals((string) $this->response, 'test1');
		}
		
		
		public function setDataArray ()
		{
			$this->response->setData(array('message' => 'test2'));
			
			$this->assertEquals((string) $this->response, 'test2');
		}
	}