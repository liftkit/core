<?php


	require_once(__DIR__ . '/../bootstrap.php');


	use LiftKit\Router\Router;
	use LiftKit\Router\Route\Route;


	class Router_Router_Test extends PHPUnit_Framework_TestCase
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

			$this->router->execute(null);
		}


		public function testCorrectMatch ()
		{
			$this->router->registerRoute(
				new Route(
					function ($input)
					{
						return $input && false;
					},
					function ()
					{
						return 'incorrect';
					}
				)
			);

			$this->router->registerRoute(
				new Route(
					function ($input)
					{
						return $input && true;
					},
					function ()
					{
						return 'correct';
					}
				)
			);

			$this->assertEquals(
				$this->router->execute(true),
				'correct'
			);
		}
	}