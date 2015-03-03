<?php

	namespace LiftKit\Router\Route\Http\Rest;


	class ControllerFactory extends Rest
	{
		/**
		 * @var callback
		 */
		protected $callback;



		public function __construct ($baseUri, $callback)
		{
			$this->baseUri  = $baseUri;
			$this->callback = $callback;
		}


		protected function getController ()
		{
			return call_user_func($this->callback);
		}
	}