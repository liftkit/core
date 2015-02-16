<?php

	namespace LiftKit\Router\Route;

	use LiftKit\Router\Route\Exception\Route as RouteException;


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
		 * @param mixed $input
		 *
		 * @return bool
		 */
		public function isValid ($input)
		{
			return (bool) call_user_func_array(
				$this->condition,
				array($input)
			);
		}


		/**
		 * @param $input
		 *
		 * @return mixed
		 */
		public function execute ($input)
		{
			return call_user_func_array(
				$this->callback,
				array($input)
			);
		}
	}