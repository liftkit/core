<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Application;

	use LiftKit\Application\Hook\Hook;
	use LiftKit\Application\Exception\UnregisteredHook as UnregisteredHookException;
	use LiftKit\Application\Exception\ReregisterHook as ReregisterHookException;
	use LiftKit\Application\Exception\InvalidHookIdentifier as InvalidHookIdentifierException;


	/**
	 * Container for encapsulating, binding, and triggering hooks.
	 *
	 * @api
	 *
	 * @package LiftKit\Application
	 */
	class Application
	{
		/**
		 * An array of hooks that have been registered.
		 *
		 * @internal
		 *
		 * @var Hook[]
		 */
		protected $hooks = array();


		/**
		 * Registers a hook with the application for future interactions.
		 *
		 * @see Hook
		 * @api
		 *
		 * @param string $key  String identifier for hook used in subsequent calls to bindHook() and triggerHook().
		 * @param Hook   $hook The hook to be registered.
		 *
		 * @throws InvalidHookIdentifierException
		 * @throws ReregisterHookException
		 */
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


		/**
		 * Binds an action to be taken when a hook is triggered. The hook must be registered before it can be bound to an action.
		 *
		 * @see Hook::bind()
		 * @api
		 *
		 * @param string      $key         String identifier of registered hook.
		 * @param callable    $closure     A closure representing the action to be taken when the hook is triggered.
		 * @param int         $precedence  Determines the order that the actions will occur in when the hook is triggered, lowest first.
		 *
		 * @throws UnregisteredHookException
		 */
		public function bindHook ($key, $closure, $precedence = 0)
		{
			if (isset($this->hooks[$key])) {
				$this->hooks[$key]->bind($closure, $precedence);
			} else {
				throw new UnregisteredHookException('Attempt to bind unregistered hook ' . $key);
			}
		}


		/**
		 * Will sequentially call each action bound to the hook. The hook must be registered before it can be bound to an action.
		 *
		 * The format of the result of this call as well as the behavior from call to call varies by the type of hook.
		 *
		 * @see Hook::trigger()
		 * @api
		 *
		 * @param string $key        String identifier of registered hook.
		 * @param array  $args       Arguments which will be passed to each callback.
		 * @param null   $precedence If supplied, the hook's actions will only be executed for a given precedence.
		 *
		 * @return mixed
		 * @throws UnregisteredHookException
		 */
		public function triggerHook ($key, $args = array(), $precedence = null)
		{
			if (isset($this->hooks[$key])) {
				return $this->hooks[$key]->trigger($args, $precedence);
			} else {
				throw new UnregisteredHookException('Attempt to trigger unregistered hook ' . $key);
			}
		}
	}


