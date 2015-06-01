<?php

	namespace LiftKit\Tests\Unit\Router;

	use LiftKit\Router\Http as Router;
	use LiftKit\Router\Route\Http\Pattern\Pattern;
	use LiftKit\Tests\Stub\Controller\Controller;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Tests\Helpers\Router\TestCase;


	class HttpTest extends TestCase
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

			$this->router->registerControllerFactory(
				'/jim',
				function ()
				{
					return new Controller(new Container);
				}
			);
		}


		/**
		 * @expectedException \LiftKit\Router\Exception\NoMatchingRoute
		 */
		public function testNoMatch ()
		{
			$this->router->execute($this->createRequest('GET', '/test'));
		}


		public function testExecute ()
		{
			$this->assertEquals(
				(string) $this->router->execute(
					$this->createRequest('GET', '/bob')
				),
				'index'
			);

			$this->assertEquals(
				(string) $this->router->execute(
					$this->createRequest('GET', '/bob/test')
				),
				'test'
			);

			$this->assertEquals(
				(string) $this->router->execute(
					$this->createRequest('GET', '/jim')
				),
				'index'
			);

			$this->assertEquals(
				(string) $this->router->execute(
					$this->createRequest('GET', '/jim/test')
				),
				'test'
			);
		}


		public function testPattern ()
		{
			$this->router->registerPattern(
				'/base/path/:arg1/:arg2',
				function ($matches)
				{
					return $matches;
				}
			)
				->setPlaceholder('arg1', Pattern::ALPHA_NUM)
				->setPlaceholder('arg2', Pattern::DIGITS);

			$matches = $this->router->execute($this->createRequest('GET', '/base/path/id/123'));

			$this->assertEquals('id', $matches['arg1']);
			$this->assertEquals('123', $matches['arg2']);
		}
	}