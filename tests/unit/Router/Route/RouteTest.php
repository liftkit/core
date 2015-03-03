<?php

	namespace LiftKit\Tests\Unit\Router\Route;

	use LiftKit\Router\Route\Route;
	use LiftKit\Tests\Helpers\Router\TestCase;


	class RouteTest extends TestCase
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
					return $input['input'] && true;
				},
				function ()
				{
					// No operation
				}
			);

			$request = $this->createRequest('POST', '/test');
			$request['input'] = true;

			$this->assertSame(
				$route->isValid($request),
				true
			);

			$request = $this->createRequest('POST', '/test');
			$request['input'] = false;

			$this->assertSame(
				$route->isValid($request),
				false
			);
		}


		public function testExecute ()
		{
			$route = new Route(
				function () {
					return true;
				},
				function ($request)
				{
					return $request['input'];
				}
			);

			$testInput = 'random string of characters';

			$request = $this->createRequest('POST', '/test');
			$request['input'] = $testInput;

			$this->assertEquals(
				(string) $route->execute($request),
				$testInput
			);
		}
	}