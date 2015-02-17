<?php


	require_once(__DIR__ . '/../bootstrap.php');
	require_once(__DIR__ . '/mock/ControllerMock.php');


	use LiftKit\Application\Application;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Response\Response;
	use LiftKit\Response\String;



	class Controller_Controller_Test extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Controller_Controller_Mock
		 */
		protected $controllerMock;


		public function setUp ()
		{
			$this->controllerMock = new Controller_Controller_Mock(
				new Application,
				new Container
			);
		}


		/**
		 * @expectedException \LiftKit\Controller\Exception\InvalidMethod
		 */
		public function testInvalidMethodException ()
		{
			$this->controllerMock->dispatch('nonexistentMethod');
		}


		/**
		 * @expectedException \LiftKit\Controller\Exception\InvalidResponse
		 */
		public function testInvalidResponseException ()
		{
			$this->controllerMock->dispatch('invalidResponse');
		}


		public function testValidStringResponse ()
		{
			$this->assertTrue(
				$this->controllerMock->validObjectResponse() instanceof String
			);
		}


		public function testValidObjectResponse ()
		{
			$this->assertTrue(
				$this->controllerMock->validObjectResponse() instanceof Response
			);
		}
	}