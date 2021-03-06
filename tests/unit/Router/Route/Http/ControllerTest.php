<?php

	namespace LiftKit\Tests\Unit\Router\Route\Http;

	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Tests\Stub\Controller\Controller;
	use LiftKit\Router\Route\Http\Controller as HttpControllerRoute;
	use LiftKit\Router\Route\Http\Pattern\Pattern;

	use LiftKit\Tests\Helpers\Router\TestCase;


	class ControllerTest extends TestCase
	{


		public function setUp ()
		{
		}


		public function testIsValid ()
		{
			$route = new HttpControllerRoute(
				'',
				$this->createController()
			);

			$this->assertTrue(
				$route->isValid(
					$this->createRequest('GET', '/test')
				)
			);

			$this->assertFalse(
				$route->isValid(
					$this->createRequest('GET', '/dasdas')
				)
			);

			$this->assertTrue(
				$route->isValid(
					$this->createRequest('GET', '/test/1/2')
				)
			);
		}


		public function testIsValidPattern ()
		{
			$pattern = new Pattern('/test/:id');
			$pattern->setPlaceholder('id', Pattern::DIGITS);

			$route = new HttpControllerRoute(
				$pattern,
				$this->createController()
			);

			$this->assertTrue(
				$route->isValid(
					$this->createRequest('GET', '/test/123')
				)
			);

			$this->assertFalse(
				$route->isValid(
					$this->createRequest('GET', '/dasdas')
				)
			);

			$this->assertTrue(
				$route->isValid(
					$this->createRequest('GET', '/test/1123/test')
				)
			);

			$this->assertFalse(
				$route->isValid(
					$this->createRequest('GET', '/test/1123/test2')
				)
			);
		}


		public function testIsValidAtSubUri ()
		{
			$route = new HttpControllerRoute(
				'/bob',
				$this->createController()
			);

			$this->assertSame(
				$route->isValid(
					$this->createRequest('GET', '/bob/test')
				),
				true
			);

			$this->assertSame(
				$route->isValid(
					$this->createRequest('GET', '/bob/action-method')
				),
				true
			);

			$this->assertSame(
				$route->isValid(
					$this->createRequest('GET', '/bob/tesadsst')
				),
				false
			);

			$this->assertSame(
				$route->isValid(
					$this->createRequest('GET', '/test')
				),
				false
			);

			$this->assertSame(
				$route->isValid(
					$this->createRequest('GET', '/bob/test/1/2')
				),
				true
			);
		}


		public function testExecute ()
		{
			$route = new HttpControllerRoute(
				'',
				$this->createController()
			);

			$this->assertEquals(
				(string) $route->execute(
					$this->createRequest('GET', '/test')
				),
				'test'
			);

			$this->assertEquals(
				(string) $route->execute(
					$this->createRequest('GET', '/index')
				),
				'index'
			);

			$this->assertEquals(
				(string) $route->execute(
					$this->createRequest('GET', '/method-with-arg/arg')
				),
				'arg'
			);
		}


		public function testExecuteAtSubUri ()
		{
			$route = new HttpControllerRoute(
				'/bob',
				$this->createController()
			);

			$this->assertEquals(
				(string) $route->execute(
					$this->createRequest('GET', '/bob/test')
				),
				'test'
			);

			$this->assertEquals(
				$route->execute(
					$this->createRequest('GET', '/bob/')
				),
				'index'
			);

			$this->assertEquals(
				$route->execute(
					$this->createRequest('GET', '/bob')
				),
				'index'
			);

			$this->assertEquals(
				$route->execute(
					$this->createRequest('GET', '/bob/method-with-arg/arg')
				),
				'arg'
			);
		}


		protected function createController()
		{
			return new Controller(
				new Container
			);
		}
	}