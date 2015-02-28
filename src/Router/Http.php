<?php


	namespace LiftKit\Router;

	use LiftKit\Controller\Controller;
	use LiftKit\Router\Route\Http\Controller as HttpControllerRoute;
	use LiftKit\Router\Route\Http\ControllerFactory as HttpControllerFactoryRoute;


	class Http extends Router
	{


		public function registerController ($baseUri, Controller $controller, $routeIdentifier = null)
		{
			$this->registerRoute(
				new HttpControllerRoute(
					$baseUri,
					$controller
				),
				$routeIdentifier
			);
		}


		public function registerControllerFactory ($baseUri, $callback, $routeIdentifier = null)
		{
			$this->registerRoute(
				new HttpControllerFactoryRoute(
					$baseUri,
					$callback
				),
				$routeIdentifier
			);
		}
	}