<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Router;


	use LiftKit\Router\Route\Route;
	use LiftKit\Request\Request;
	use LiftKit\Response\Response;
	use LiftKit\Router\Exception\NoMatchingRoute as NoMatchingRouteException;


	/**
	 * Class Router
	 *
	 * @package LiftKit\Router
	 */
	class Router
	{
		/**
		 * @var Route[]
		 */
		protected $routes = array();


		/**
		 * @param Route $route
		 * @param null|string  $routeIdentifier
		 */
		public function registerRoute (Route $route, $routeIdentifier = null)
		{
			if (! $routeIdentifier) {
				$routeIdentifier = uniqid();
			}

			$this->routes[$routeIdentifier] = $route;
		}


		/**
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function execute (Request $request)
		{
			foreach ($this->routes as $route) {
				if ($route->isValid($request)) {
					return $route->execute($request);
				}
			}

			throw new NoMatchingRouteException('No matching route found.');
		}
	}