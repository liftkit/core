<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *	hook.event.php
	 *  by Ryan Williams, 2013
	 *	© Ryan Williams & Stream 9, LLC
	 *
	 *  Stream 9 LLC
	 *	Cleveland, Ohio, USA
	 *	stream9.net
	 *
	 *  This framework is the sole property of Ryan Williams and Stream 9, LLC.  It may not
	 *	be used for any purpose without the expressed consent of its owners.
	 *
	 *
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Class Event
	 *
	 * @package LiftKit\Application\Hook
	 */
	class Event extends Hook
	{


		/**
		 * trigger function.
		 *
		 * Invokes all hooks of a given precedence for a given event. If null precedence is provided,
		 * invokes all hooks for a given event, regardless of precedence.
		 *
		 * @access public
		 *
		 * @param mixed $event
		 * @param mixed $args
		 * @param mixed $precedence (default: null)
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



