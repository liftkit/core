<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Application\Hook;


	/**
	 * Class Hook
	 *
	 * @package LiftKit\Application\Hook
	 */
	abstract class Hook
	{
		protected $hooks = array();


		/**
		 * bind function.
		 *
		 * Assigns new hook for a given action. Optional precedence may be assigned.
		 *
		 * @access public
		 *
		 * @param callable $function
		 * @param int      $precedence (default: 0)
		 *
		 * @return void
		 */
		public function bind ($function, $precedence = 0)
		{
			$this->hooks[$precedence][] = $function;
		}


		/**
		 * release function.
		 *
		 * Releases hooks depending on input. May be done for all hooks, individual hooks, or
		 * individual precedence levels for an given hook.
		 *
		 * @access public
		 *
		 * @param mixed $precedence (default: null)
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
		abstract public function trigger ($value, $precedence = null);
	}



