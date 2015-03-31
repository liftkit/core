<?php


	namespace LiftKit\Tests\Unit\Router\Route\Http\Rest;

	use LiftKit\Tests\Helpers\Router\TestCase;

	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Tests\Stub\Controller\Rest as Controller;
	use LiftKit\Router\Route\Http\Rest\Controller as HttpRestControllerRoute;


	class ControllerTest extends TestCase
	{
		/**
		 * @var HttpRestControllerRoute
		 */
		protected $indexRoute;


		/**
		 * @var HttpRestControllerRoute
		 */
		protected $subRoute;


		public function setUp ()
		{
			$this->indexRoute = new HttpRestControllerRoute(
				'',
				$this->createController()
			);

			$this->subRoute = new HttpRestControllerRoute(
				'/george',
				$this->createController()
			);
		}


		public function testIsValidIndex ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('GET', '/')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('PUT', '/')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('GET', '/george')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('GET', '/george/')
				)
			);

			$this->assertEquals(
				false,
				$this->subRoute->isValid(
					$this->createRequest('PUT', '/george')
				)
			);
		}


		public function testIsValidGet ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('GET', '/1')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('GET', '/1/2')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('PUT', '/')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('GET', '/george/test')
				)
			);

			$this->assertEquals(
				false,
				$this->subRoute->isValid(
					$this->createRequest('GET', '/george/test/3')
				)
			);
		}


		public function testIsValidInsert ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('POST', '/')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('POST', '/george/')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('POST', '/george')
				)
			);
		}


		public function testIsValidUpdate ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('POST', '/1')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('POST', '/1/2')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('POST', '/george/test')
				)
			);

			$this->assertEquals(
				false,
				$this->subRoute->isValid(
					$this->createRequest('POST', '/george/test/3')
				)
			);
		}


		public function testIsValidDelete ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('DELETE', '/1')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('DELETE', '/')
				)
			);

			$this->assertEquals(
				false,
				$this->indexRoute->isValid(
					$this->createRequest('DELETE', '/1/2')
				)
			);

			$this->assertEquals(
				true,
				$this->subRoute->isValid(
					$this->createRequest('DELETE', '/george/test')
				)
			);

			$this->assertEquals(
				false,
				$this->subRoute->isValid(
					$this->createRequest('DELETE', '/george/test/3')
				)
			);
		}


		public function testExamplePage ()
		{
			$this->assertEquals(
				true,
				$this->indexRoute->isValid(
					$this->createRequest('GET', '/example')
				)
			);

			$this->assertEquals(
				'example',
				$this->indexRoute->execute(
					$this->createRequest('GET', '/example')
				)
			);
		}


		public function testIsExecuteIndex ()
		{
			$this->assertEquals(
				'index',
				(string) $this->indexRoute->execute(
					$this->createRequest('GET', '/')
				)
			);

			$this->assertEquals(
				'index',
				(string) $this->subRoute->execute(
					$this->createRequest('GET', '/george')
				)
			);
		}


		public function testIsExecuteGet ()
		{
			$this->assertEquals(
				'get: 1',
				(string) $this->indexRoute->execute(
					$this->createRequest('GET', '/1')
				)
			);

			$this->assertEquals(
				'get: 1',
				(string) $this->subRoute->execute(
					$this->createRequest('GET', '/george/1')
				)
			);
		}


		public function testIsExecuteInsert ()
		{
			$this->assertEquals(
				'insert',
				(string) $this->indexRoute->execute(
					$this->createRequest('POST', '/')
				)
			);

			$this->assertEquals(
				'insert',
				(string) $this->subRoute->execute(
					$this->createRequest('POST', '/george')
				)
			);
		}


		public function testIsExecuteUpdate ()
		{
			$this->assertEquals(
				'update: 1',
				(string) $this->indexRoute->execute(
					$this->createRequest('POST', '/1')
				)
			);

			$this->assertEquals(
				'update: 1',
				(string) $this->subRoute->execute(
					$this->createRequest('POST', '/george/1')
				)
			);
		}


		public function testIsExecuteDelete ()
		{
			$this->assertEquals(
				'delete: 1',
				(string) $this->indexRoute->execute(
					$this->createRequest('DELETE', '/1')
				)
			);

			$this->assertEquals(
				'delete: 1',
				(string) $this->subRoute->execute(
					$this->createRequest('DELETE', '/george/1')
				)
			);
		}



		protected function createController ()
		{
			return new Controller(new Container);
		}
	}