<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route\Http\Rest;

	use LiftKit\Controller\RestInterface as AbstractController;
	use LiftKit\Request\Request;


	/**
	 * REST Controller HTTP Route
	 *
	 * A route for attaching a REST Controller to a base URI, but it takes request methods into account.
	 *
	 * @see \LiftKit\Router\Route\Http\Controller
	 *
	 * @package LiftKit\Router\Route\Http\Rest
	 */
	class Controller extends Rest
	{
		/**
		 * @internal
		 *
		 * @var AbstractController
		 */
		protected $controller;


		/**
		 * Constructor
		 *
		 * @param callable           $baseUri    Base URI to attach route to
		 * @param AbstractController $controller Controller to attach
		 */
		public function __construct ($baseUri, AbstractController $controller)
		{
			$this->baseUri    = $baseUri;
			$this->controller = $controller;
		}


		/**
		 * @internal
		 *
		 * @return AbstractController
		 */
		public function getController (Request $request)
		{
			return $this->controller;
		}
	}