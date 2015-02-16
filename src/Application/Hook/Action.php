<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 *
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Class Action
	 *
	 * @package LiftKit\Application\Hook
	 */
	class Action extends Hook
	{


		/**
		 * trigger function.
		 *
		 * Invokes all hooks of a given precedence for a given event. If null precedence is provided,
		 * invokes all hooks for a given event, regardless of precedence.
		 *
		 * @access public
		 *
		 * @param mixed $value
		 * @param mixed $precedence (default: null)
		 *
		 * @return mixed
		 */
		public function trigger ($value, $precedence = null)
		{
			if (is_null($precedence)) {
				$functions = array();

				ksort($this->hooks);

				foreach ($this->hooks as $function_set) {
					foreach ($function_set as $function) {
						$functions[] = $function;
					}
				}

				foreach ($functions as $function) {
					$value = call_user_func_array($function, array($value));
				}

				return $value;

			} else {
				if (isset($this->hooks[$precedence])) {
					foreach ($this->hooks[$precedence] as $function) {
						$value = call_user_func_array($function, array($value));
					}
				}

				return $value;
			}
		}
	}



