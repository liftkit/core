<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 *
	 */


	namespace LiftKit\Application;

	use LiftKit\Application\Hook\Hook;
	use LiftKit\Application\Exception\UnregisteredHook as UnregisteredHookException;
	use LiftKit\Application\Exception\ReregisterHook as ReregisterHookException;
	use LiftKit\Application\Exception\InvalidHookIdentifier as InvalidHookIdentifierException;


	/**
	 * Class Application
	 *
	 * @package LiftKit\Application
	 */
	class Application
	{
		/**
		 * @var Hook[]
		 */
		protected $hooks = array();


		public function registerHook ($key, Hook $hook)
		{
			if (isset($this->hooks[$key])) {
				throw new ReregisterHookException('Attempt to re-register hook ' . $key);
			}

			if (! $key || ! is_string($key)) {
				throw new InvalidHookIdentifierException('Invalid hook identifier ' . var_export($key, true));
			}

			$this->hooks[$key] = $hook;
		}


		public function bindHook ($key, $closure, $precedence = 0)
		{
			if (isset($this->hooks[$key])) {
				$this->hooks[$key]->bind($closure, $precedence);
			} else {
				throw new UnregisteredHookException('Attempt to bind unregistered hook ' . $key);
			}
		}


		public function triggerHook ($key, $args = array(), $precedence = 0)
		{
			if (isset($this->hooks[$key])) {
				return $this->hooks[$key]->trigger($args, $precedence);
			} else {
				throw new UnregisteredHookException('Attempt to trigger unregistered hook ' . $key);
			}
		}
	}


