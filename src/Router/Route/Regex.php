<?php

	namespace LiftKit\Router\Route;


	use LiftKit\Router\Route\Exception\Route as RouteException;


	class Regex extends Route
	{


		/**
		 * @param string $condition
		 * @param callable $callback
		 */
		public function __construct ($condition, $callback)
		{
			if (! is_callable($callback)) {
				throw new RouteException('The route callback must be a valid callable.');
			}

			$this->condition = $condition;
			$this->callback  = $callback;
		}


		/**
		 * @param string $input
		 *
		 * @return bool
		 */
		public function isValid ($input)
		{
			return (bool) preg_match($this->condition, $input);
		}


		/**
		 * @param $input
		 *
		 * @return mixed
		 */
		public function execute ($input)
		{
			preg_match($this->condition, $input, $matches);

			return call_user_func_array(
				$this->callback,
				array($matches)
			);
		}
	}