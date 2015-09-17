<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route\Http\Rest;

	use LiftKit\Request\Request;
	use LiftKit\Router\Route\Http\Pattern\Pattern;


	/**
	 * REST Controller Factory Route
	 *
	 * Similar to but instead of attaching an instance of a REST Controller, a factory callback is provided instead
	 *
	 * @see \LiftKit\Router\Route\Http\Controller
	 *
	 * @package LiftKit\Router\Route\Http
	 */
	class ControllerFactory extends Rest
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
		 * @param callable $baseUri  Base URI to attach route to
		 * @param callable $callback Factory callback that returns Controller
		 */
		public function __construct ($baseUri, callable $callback)
		{
			$this->baseUri  = $baseUri;
			$this->callback = $callback;
		}


		/**
		 * @internal
		 *
		 * @return mixed
		 */
		protected function getController (Request $request)
		{
			if ($this->baseUri instanceof Pattern) {
				return call_user_func_array(
					$this->callback,
					array($this->baseUri->matches($request->getUri(), true))
				);
			} else {
				return call_user_func($this->callback);
			}
		}
	}