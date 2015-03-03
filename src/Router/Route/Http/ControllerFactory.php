<?php

	namespace LiftKit\Router\Route\Http;


	class ControllerFactory extends Http
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