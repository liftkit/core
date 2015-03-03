<?php

	namespace LiftKit\Router\Route;

	use LiftKit\Router\Route\Exception\Route as RouteException;
	use LiftKit\Request\Request;
	use LiftKit\Response\Response;


	class Route
	{
		/**
		 * @var callable
		 */
		protected $condition;

		/**
		 * @var callable
		 */
		protected $callback;


		/**
		 * @param callable $condition
		 * @param callable $callback
		 */
		public function __construct ($condition, $callback)
		{
			if (! is_callable($condition) || ! is_callable($callback)) {
				throw new RouteException('Both route conditions and callback must be valid callables.');
			}

			$this->condition = $condition;
			$this->callback  = $callback;
		}


		/**
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