<?php


	namespace LiftKit\Tests\Unit\Router\Route\Http\Rest;

	use LiftKit\Router\Route\Http\Rest\ControllerFactory as HttpRestControllerFactoryRoute;


	class RestControllerFactoryTest extends ControllerTest
	{
		/**
		 * @var HttpRestControllerFactoryRoute
		 */
		protected $indexRoute;


		/**
		 * @var HttpRestControllerFactoryRoute
		 */
		protected $subRoute;


		public function setUp ()
		{
			$this->indexRoute = new HttpRestControllerFactoryRoute(
				'',
				function () {
					return $this->createController();
				}
			);

			$this->subRoute = new HttpRestControllerFactoryRoute(
				'/george',
				function () {
					return $this->createController();
				}
			);
		}
	}