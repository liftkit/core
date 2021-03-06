<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Router;

	use LiftKit\Controller\Controller;
	use LiftKit\Router\Route\Http\Controller as HttpControllerRoute;
	use LiftKit\Router\Route\Http\ControllerFactory as HttpControllerFactoryRoute;
	use LiftKit\Router\Route\Http\Rest\Controller as RestControllerRoute;
	use LiftKit\Router\Route\Http\Rest\ControllerFactory as RestControllerFactoryRoute;
	use LiftKit\Router\Route\Http\Pattern\Pattern;
	use LiftKit\Router\Route\Http\Pattern\Route as PatternRoute;


	/**
	 * HTTP Router
	 *
	 * A special router that provides utility methods for creating routes specific to HTTP Requests
	 *
	 * @package LiftKit\Router
	 */
	class Http extends Router
	{


		/**
		 * This utility method registers a \LiftKit\Router\Route\Http\Controller route. It matches based on the $baseUri parameter
		 * and whether the controller has a method with a matching name.
		 *
		 * @api
		 * @see HttpControllerRoute
		 *
		 * @param string     $baseUri          The URI to attach the controller to
		 * @param Controller $controller       A Controller for requests that match
		 * @param null       $routeIdentifier  An optional string identifier
		 */
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


		/**
		 * This utility method registers a \LiftKit\Router\Route\Http\ControllerFactory route. It matches based on the $baseUri parameter
		 * and whether the controller has a method with a matching name.
		 *
		 * @api
		 * @see HttpControllerFactoryRoute
		 *
		 * @param string     $baseUri          The URI to attach the controller to
		 * @param callable   $callback         A callback function to create the Controller
		 * @param null       $routeIdentifier  An optional string identifier
		 */
		public function registerControllerFactory ($baseUri, callable $callback, $routeIdentifier = null)
		{
			$this->registerRoute(
				new HttpControllerFactoryRoute(
					$baseUri,
					$callback
				),
				$routeIdentifier
			);
		}


		/**
		 * This utility method registers a \LiftKit\Router\Route\Http\Rest\Controller route. It matches based on the $baseUri parameter
		 * and whether the controller has a method with a matching name.
		 *
		 * @api
		 * @see RestControllerRoute
		 *
		 * @param string     $baseUri          The URI to attach the controller to
		 * @param Controller $controller       A Controller for requests that match
		 * @param null       $routeIdentifier  An optional string identifier
		 */
		public function registerRestController ($baseUri, Controller $controller, $routeIdentifier = null)
		{
			$this->registerRoute(
				new RestControllerRoute(
					$baseUri,
					$controller
				),
				$routeIdentifier
			);
		}


		/**
		 * This utility method registers a \LiftKit\Router\Route\Http\Rest\ControllerFactory route. It matches based on the $baseUri parameter
		 * and whether the controller has a method with a matching name.
		 *
		 * @api
		 * @see RestControllerFactoryRoute
		 *
		 * @param string     $baseUri          The URI to attach the controller to
		 * @param callable   $callback         A callback function to create the Controller
		 * @param null       $routeIdentifier  An optional string identifier
		 */
		public function registerRestControllerFactory ($baseUri, callable $callback, $routeIdentifier = null)
		{
			$this->registerRoute(
				new RestControllerFactoryRoute(
					$baseUri,
					$callback
				),
				$routeIdentifier
			);
		}


		public function registerPattern ($patternString, callable $callback, $method = PatternRoute::METHOD_ANY, $routeIdentifier = null)
		{
			$pattern = new Pattern($patternString);

			$this->registerRoute(
				new PatternRoute(
					$pattern,
					$callback,
					$method
				),
				$routeIdentifier
			);

			return $pattern;
		}


		public function createPattern ($patternString, $prefix = ':', $delimeter = '#')
		{
			return new Pattern($patternString, $prefix, $delimeter);
		}
	}