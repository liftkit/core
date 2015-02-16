<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Router;


	use LiftKit\Router\Route\Route;
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
		 * @param mixed $input
		 *
		 * @return bool|mixed
		 */
		public function execute ($input)
		{
			foreach ($this->routes as $route) {
				if ($route->isValid($input)) {
					return $route->execute($input);
				}
			}

			throw new NoMatchingRouteException('No matching route found.');
		}
	}