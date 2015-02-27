<?php

	namespace LiftKit\Tests\Unit\Router;

	use LiftKit\Router\Http as Router;
	use LiftKit\Tests\Stub\Controller\Controller;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Application\Application;

	use PHPUnit_Framework_TestCase;


	class HttpTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Router
		 */
		protected $router;


		public function setUp ()
		{
			$this->router = new Router();
			$controller = new Controller(new Container);

			$this->router->registerController('/bob', $controller);
		}


		/**
		 * @expectedException \LiftKit\Router\Exception\NoMatchingRoute
		 */
		public function testNoMatch ()
		{
			$this->router->execute('/test');
		}


		public function testExecute ()
		{
			$this->assertEquals(
				$this->router->execute('/bob'),
				'index'
			);

			$this->assertEquals(
				$this->router->execute('/bob/test'),
				'test'
			);
		}
	}