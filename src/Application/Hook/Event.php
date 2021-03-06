<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Defines an Event hook
	 *
	 * This class defines a type of hook that simply triggers each callback sequentially. The callbacks can accept an arbitrary
	 * number of arguments, but they must match each other's signature. The result of each callback is return in an array
	 *
	 * @package LiftKit\Application\Hook
	 */
	class Event extends Hook
	{


		/**
		 * Invokes all callback attached to the event
		 *
		 * If null precedence is provided, invokes all hooks for a given event, regardless of precedence.
		 *
		 * @api
		 *
		 * @param array $args                       An array of parameters to be passed to each hook.
		 * @param mixed $precedence (default: null) If provided, this hook will only execute the callbacks of the supplied precedence.
		 *
		 * @return array
		 */
		public function trigger ($args = array(), $precedence = null)
		{
			if (is_null($precedence)) {
				$functions = array();
				ksort($this->hooks);

				foreach ($this->hooks as $function_set) {
					foreach ($function_set as $function) {
						$functions[] = $function;
					}
				}

				$return = array();

				foreach ($functions as $function) {
					$return[] = call_user_func_array($function, $args);
				}

				return $return;

			} else {
				$return = array();

				if (isset($this->hooks[$precedence]) && is_array($this->hooks[$precedence])) {
					foreach ($this->hooks[$precedence] as $function) {
						$return[] = call_user_func_array($function, $args);
					}
				}

				return $return;
			}
		}
	}



