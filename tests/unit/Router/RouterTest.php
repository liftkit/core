<?php

	namespace LiftKit\Tests\Unit\Router;

	use LiftKit\Router\Router;
	use LiftKit\Router\Route\Route;

	use LiftKit\Tests\Helpers\Router\TestCase;


	class RouterTest extends TestCase
	{
		/**
		 * @var Router
		 */
		protected $router;


		public function setUp ()
		{
			$this->router = new Router();
		}


		/**
		 * @expectedException \LiftKit\Router\Exception\NoMatchingRoute
		 */
		public function testNoMatch ()
		{
			$request = $this->createRequest('GET', '/test');

			$this->router->registerRoute(
				new Route(
					function ()
					{
						return false;
					}, function ()
				{
					// No action
				}
				)
			);

			$this->router->execute($request);
		}


		public function testCorrectMatch ()
		{
			$request = $this->createRequest('GET', '/test');

			$this->router->registerRoute(
				new Route(
					function ()
					{
						return false;
					},
					function ()
					{
						return 'incorrect';
					}
				)
			);

			$this->router->registerRoute(
				new Route(
					function ()
					{
						return true;
					},
					function ()
					{
						return 'correct';
					}
				)
			);

			$this->assertEquals(
				$this->router->execute($request),
				'correct'
			);
		}
	}