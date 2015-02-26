<?php

	namespace LiftKit\Tests\Unit\Router\Route;

	use LiftKit\Router\Route\Route;
	use PHPUnit_Framework_TestCase;


	class RouteTest extends PHPUnit_Framework_TestCase
	{


		public function setUp ()
		{
		}


		/**
		 * @expectedException     \LiftKit\Router\Route\Exception\Route
		 */
		public function testIncorrectCondition ()
		{
			new Route(
				'bad input',
				function () {}
			);
		}


		/**
		 * @expectedException     \LiftKit\Router\Route\Exception\Route
		 */
		public function testIncorrectCallback ()
		{
			new Route(
				function () {},
				'bad input'
			);
		}


		public function testIsValid ()
		{
			$route = new Route(
				function ($input) {
					return $input && true;
				},
				function ()
				{
					// No operation
				}
			);

			$this->assertSame(
				$route->isValid(true),
				true
			);

			$this->assertSame(
				$route->isValid(false),
				false
			);
		}


		public function testExecute ()
		{
			$route = new Route(
				function () {
					return true;
				},
				function ($output)
				{
					return $output;
				}
			);

			$testInput = 'random string of characters';

			$this->assertEquals(
				$route->execute($testInput),
				$testInput
			);
		}
	}