<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route;

	use LiftKit\Router\Route\Exception\Route as RouteException;
	use LiftKit\Request\Request;
	use LiftKit\Response\Response;


	/**
	 * Route
	 *
	 * Basic route class. All routes have two responsibilities:
	 *
	 *  - Determine whether the route matches a Request
	 *  - Do something if it does match, using the Request to determine what
	 *
	 * @package LiftKit\Router\Route
	 */
	class Route
	{
		/**
		 * Callback that determines whether the route matches
		 *
		 * @internal
		 *
		 * @var callable
		 */
		protected $condition;

		/**
		 * Callback that represents the action to be taken if the route matches
		 *
		 * @internal
		 *
		 * @var callable
		 */
		protected $callback;


		/**
		 * Constructor
		 *
		 * @api
		 *
		 * @param callable $condition Callback that takes a Request as a parameter and returns a boolean indicating whether the Route matches
		 * @param callable $callback  Callback that represents the action to be taken if the route matches, takes a Request as a parameter
		 */
		public function __construct (callable $condition, callable $callback)
		{
			$this->condition = $condition;
			$this->callback  = $callback;
		}


		/**
		 * Returns whether the route matches the supplied request
		 *
		 * @api
		 *
		 * @param Request $request
		 *
		 * @return bool
		 */
		public function isValid (Request $request)
		{
			return (bool) call_user_func_array(
				$this->condition,
				array($request)
			);
		}


		/**
		 * Executes callback with supplied Request
		 *
		 * @api
		 *
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function execute (Request $request)
		{
			return call_user_func_array(
				$this->callback,
				array($request)
			);
		}
	}