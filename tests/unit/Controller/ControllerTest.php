<?php

	namespace LiftKit\Tests\Unit\Controller;
	
	use LiftKit\Tests\Mock\Controller\Controller;

	use LiftKit\Application\Application;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Response\Response;
	use LiftKit\Response\String;
	
	use PHPUnit_Framework_TestCase;


	class ControllerTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Controller_Controller_Mock
		 */
		protected $controllerMock;


		public function setUp ()
		{
			$this->controllerMock = new Controller(
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