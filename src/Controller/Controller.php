<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Controller;

	use LiftKit\Response\Response;
	use LiftKit\Response\String as StringResponse;

	use LiftKit\DependencyInjection\Container\Container;

	use LiftKit\Controller\Exception\InvalidResponse as InvalidResponseException;
	use LiftKit\Controller\Exception\InvalidMethod as InvalidMethodException;


	/**
	 * Abstract Controller Class
	 *
	 * This class defines an abstraction for a Controller. A controller acts as the gateway between a Request and a the business logic.
	 * A Router will execute a Request to determine which Controller action to take. Controller actions should be public methods
	 * which return a valid Response object, acting as the glue for an application.
	 *
	 * @api
	 *
	 * @package LiftKit\Controller
	 */
	abstract class Controller
	{
		/**
		 * Dependency injection container
		 *
		 * @api
		 *
		 * @var Container
		 */
		protected $container;


		/**
		 * Initializes object
		 *
		 * @param Container $container
		 */
		public function __construct (Container $container)
		{
			$this->container   = $container;
		}


		/**
		 * Dispatches a Controller action.
		 *
		 * @api
		 *
		 * @param string $method The name of the method to be executed.
		 * @param array  $args   An array of arguments to be passed to the method.
		 *
		 * @return Response
		 * @throws InvalidResponseException
		 * @throws InvalidMethodException
		 */
		public function dispatch ($method, $args = array())
		{
			if (is_callable(array($this, $method))) {
				$response = call_user_func_array(
					array($this, $method),
					$args
				);
			} else {
				throw new InvalidMethodException('Invalid controller method ' . $method);
			}

			if ($response instanceof Response) {
				return $response;
			} else if (is_string($response)) {
				return new StringResponse($response);
			} else {
				throw new InvalidResponseException('Invalid response.');
			}
		}


		/**
		 * Will indicate whether the controller responds to a particular combination of method and arguments.
		 *
		 * @api
		 *
		 * @param string $method The name of the method to be executed.
		 * @param array  $args   An array of arguments to be passed to the method.
		 *
		 * @return bool true if the controller can respond, false if not
		 */
		public function respondsTo ($method, $args = array())
		{
			return method_exists($this, $method);
		}
	}

