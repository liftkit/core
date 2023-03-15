<?php

	namespace LiftKit\Tests\Unit\Controller;

	use LiftKit\Tests\Stub\Controller\Controller;

	use LiftKit\Application\Application;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Response\Response;
	use LiftKit\Response\StringResponse;

	use PHPUnit_Framework_TestCase;


	class ControllerTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Controller
		 */
		protected $controller;


		public function setUp ()
		{
			$this->controller = new Controller(
				new Container
			);
		}


		/**
		 * @expectedException \LiftKit\Controller\Exception\InvalidMethod
		 */
		public function testInvalidMethodException ()
		{
			$this->controller->dispatch('nonexistentMethod');
		}


		/**
		 * @expectedException \LiftKit\Controller\Exception\InvalidResponse
		 */
		public function testInvalidResponseException ()
		{
			$this->controller->dispatch('invalidResponse');
		}


		public function testRespondsTo ()
		{
			$this->assertTrue(
				$this->controller->respondsTo('test')
			);

			$this->assertTrue(
				$this->controller->respondsTo('index')
			);

			$this->assertFalse(
				$this->controller->respondsTo('dasd')
			);
		}


		public function testValidStringResponse ()
		{
			$this->assertTrue(
				$this->controller->dispatch('validStringResponse') instanceof StringResponse
			);
		}


		public function testValidObjectResponse ()
		{
			$this->assertTrue(
				$this->controller->dispatch('validObjectResponse') instanceof Response
			);
		}
	}
