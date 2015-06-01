<?php

	namespace LiftKit\Tests\Unit\Router\Route\Http\Pattern\Route;


	use LiftKit\Request\Request;
	use LiftKit\Tests\Helpers\Router\TestCase;
	use LiftKit\Router\Route\Http\Pattern\Route;
	use LiftKit\Router\Route\Http\Pattern\Pattern;


	class RouteTest extends TestCase
	{


		public function setUp ()
		{
		}


		public function testIsValid ()
		{
			$pattern = new Pattern('/base/path/:arg1/:arg2');

			$pattern->setPlaceholder('arg1', Pattern::ALPHA_NUM);
			$pattern->setPlaceholder('arg2', Pattern::DIGITS);

			$route = new Route(
				$pattern,
				function ($matches, Request $request)
				{

				},
				Route::METHOD_POST
			);

			$this->assertFalse(
				$route->isValid(
					$this->createRequest('POST', '/test')
				)
			);

			$this->assertFalse(
				$route->isValid(
					$this->createRequest('GET', '/base/path/id/123')
				)
			);

			$this->assertTrue(
				$route->isValid(
					$this->createRequest('POST', '/base/path/id/123')
				)
			);
		}


		public function testExecute ()
		{
			$pattern = new Pattern('/base/path/:arg1/:arg2');

			$pattern->setPlaceholder('arg1', Pattern::ALPHA_NUM);
			$pattern->setPlaceholder('arg2', Pattern::DIGITS);

			$outerMatches = null;
			$outerRequest = null;

			$request = $this->createRequest('POST', '/base/path/id/123');

			$route = new Route(
				$pattern,
				function ($matches, Request $request) use (&$outerRequest, &$outerMatches)
				{
					$outerMatches = $matches;
					$outerRequest = $request;
				},
				Route::METHOD_POST
			);

			$route->execute($request);

			$this->assertSame(
				$request,
				$outerRequest
			);

			$this->assertEquals(
				[
					0 => '/base/path/id/123',
					1 => 'id',
					'arg1' => 'id',
					2 => '123',
					'arg2' => '123',
				],
				$outerMatches
			);
		}
	}