<?php


	namespace LiftKit\Controller;

	use LiftKit\Application\Application;

	use LiftKit\Response\Response;
	use LiftKit\Response\String as StringResponse;

	use LiftKit\DependencyInjection\Container\Container;

	use LiftKit\Controller\Exception\InvalidResponse as InvalidResponseException;
	use LiftKit\Controller\Exception\InvalidMethod as InvalidMethodException;


	/**
	 * Class Controller
	 *
	 * @package LiftKit\Controller
	 */
	abstract class Controller
	{
		/**
		 * @var Container
		 */
		protected $container;


		/**
		 * @param Container $container
		 */
		public function __construct (Container $container)
		{
			$this->container   = $container;
		}


		/**
		 * @param       $method
		 * @param array $args
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


		public function respondsTo ($method, $args = array())
		{
			return method_exists($this, $method);
		}
	}

