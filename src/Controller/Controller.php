<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Controller;

	use LiftKit\Application\Application;
	use LiftKit\Response\Response;
	use LiftKit\Response\String as StringResponse;
	use LiftKit\Controller\Exception\InvalidResponse as InvalidResponseException;


	/**
	 * Class Controller
	 *
	 * @package LiftKit\Controller
	 */
	abstract class Controller
	{
		/**
		 * @var Application
		 */
		protected $application;


		/**
		 * @param Application $application
		 */
		public function __construct (Application $application)
		{
			$this->application = $application;
		}


		/**
		 * @param       $method
		 * @param array $args
		 *
		 * @return Response
		 * @throws InvalidResponseException
		 */
		public function dispatch ($method, $args = array())
		{
			$response = call_user_func_array(
				array($this, $method),
				$args
			);

			if ($response instanceof Response) {
				return $response;
			} else if (is_string($response)) {
				return new StringResponse($response);
			} else {
				throw new InvalidResponseException('Invalid response.');
			}
		}
	}

