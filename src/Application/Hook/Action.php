<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Defines an Action hook.
	 *
	 * An action hook passes the result of each action to the subsequent one, allowing for a sequential transformation from one value
	 * to another. Because of this, the callbacks associated with action hooks must accept one parameter, perform any transformation
	 * to be made to the parameter, and return its transformed result.
	 *
	 * @package LiftKit\Application\Hook
	 */
	class Action extends Hook
	{


		/**
		 * Invokes all hooks of a given precedence for a given event.
		 *
		 * If null precedence is provided, invokes all hooks for a given event, regardless of precedence.
		 *
		 * @api
		 *
		 * @param mixed $value                      The value to be transformed.
		 * @param mixed $precedence (default: null) If provided, only callbacks of this precedence will be executed.
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



