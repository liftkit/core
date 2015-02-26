<?php

	namespace LiftKit\Tests\Unit\Router\Route\Http;

	use LiftKit\Application\Application;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Tests\Stub\Controller\Controller;
	use LiftKit\Router\Route\Http\Controller as HttpControllerRoute;
	use PHPUnit_Framework_TestCase;


	class ControllerTest extends PHPUnit_Framework_TestCase
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

			$this->assertSame(
				$route->isValid('/test'),
				true
			);

			$this->assertSame(
				$route->isValid('/test'),
				true
			);

			$this->assertSame(
				$route->isValid('/dasds'),
				false
			);

			$this->assertSame(
				$route->isValid('/test/1/2'),
				true
			);
		}


		public function testIsValidAtSubUri ()
		{
			$route = new HttpControllerRoute(
				'/bob',
				$this->createController()
			);

			$this->assertSame(
				$route->isValid('/bob/test'),
				true
			);

			$this->assertSame(
				$route->isValid('/bob/action-method'),
				true
			);

			$this->assertSame(
				$route->isValid('/bob/dasds'),
				false
			);

			$this->assertSame(
				$route->isValid('/test'),
				false
			);

			$this->assertSame(
				$route->isValid('/bob/test/1/2'),
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
				$route->execute('/test'),
				'test'
			);

			$this->assertSame(
				$route->isValid('/action-method'),
				true
			);

			$this->assertEquals(
				$route->execute('/'),
				'index'
			);

			$this->assertEquals(
				$route->execute('/method-with-arg/arg'),
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
				$route->execute('/bob/test'),
				'test'
			);

			$this->assertEquals(
				$route->execute('/bob/'),
				'index'
			);

			$this->assertEquals(
				$route->execute('/bob/method-with-arg/arg'),
				'arg'
			);
		}


		protected function createController()
		{
			return new Controller(
				new Application,
				new Container
			);
		}
	}