<?php


	namespace LiftKit\Router;

	use LiftKit\Controller\Controller;
	use LiftKit\Router\Route\Http\Controller as HttpControllerRoute;


	class Http extends Router
	{


		public function registerController ($baseUri, Controller $controller, $routeIdentifier = null)
		{
			$this->registerRoute(
				new HttpControllerRoute(
					$baseUri,
					$controller,
					$routeIdentifier
				)
			);
		}
	}