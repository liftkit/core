<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Abstract Hook type
	 *
	 * This class defines an abstract Hook type. A Hook is a container around a set of callbacks. When the hook is triggered
	 *
	 * @package LiftKit\Application\Hook
	 */
	abstract class Hook
	{
		/**
		 * An array of callbacks to be executed when a hook is triggered.
		 *
		 * @internal
		 *
		 * @var callable[]
		 */
		protected $hooks = array();


		/**
		 * Assigns new hook for a given action
		 *
		 * Optional precedence may be assigned.
		 *
		 * @api
		 *
		 * @param callable $function
		 * @param int      $precedence (default: 0)
		 *
		 * @return void
		 */
		public function bind (callable $function, $precedence = 0)
		{
			$this->hooks[$precedence][] = $function;
		}


		/**
		 * Releases callbacks which have already been bound
		 *
		 * May be done for all callbacks, individual precedence levels for an given hook.
		 *
		 * @api
		 *
		 * @param mixed $precedence (default: null) If supplied, will only the callbacks for a given precedence.
		 *
		 * @return void
		 */
		public function release ($precedence = null)
		{
			if ($precedence) {
				unset($this->hooks[$precedence]);
			} else {
				$this->hooks = array();
			}
		}


		/**
		 * Invokes all hooks of a given precedence for a given event.
		 *
		 * The implementation will determine the exact behavior of how the callbacks interact.
		 *
		 * @api
		 *
		 * @param mixed $value
		 * @param mixed $precedence (default: null)
		 *
		 * @return mixed
		 */
		abstract public function trigger ($value, $precedence = null);
	}



