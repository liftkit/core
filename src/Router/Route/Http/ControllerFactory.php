<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Controller\Controller;

	/**
	 * Controller Factory Route
	 *
	 * Similar to but instead of attaching an instance of a Controller, a factory callback is provided instead
	 *
	 * @see \LiftKit\Router\Route\Http\Controller
	 *
	 * @package LiftKit\Router\Route\Http
	 */
	class ControllerFactory extends Http
	{
		/**
		 * @internal
		 *
		 * @var callback
		 */
		protected $callback;


		/**
		 * Constructor
		 *
		 * @param string   $baseUri  Base URI to attach controller to
		 * @param callable $callback Factory callback to create Controller
		 */
		public function __construct ($baseUri, callable $callback)
		{
			$this->baseUri  = $baseUri;
			$this->callback = $callback;
		}


		/**
		 * @internal
		 *
		 * @return Controller
		 */
		protected function getController ()
		{
			return call_user_func($this->callback);
		}
	}