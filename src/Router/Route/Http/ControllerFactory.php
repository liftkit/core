<?php

	namespace LiftKit\Router\Route\Http;


	class ControllerFactory extends Http
	{
		/**
		 * @var string
		 */
		protected $baseUri;

		/**
		 * @var callback
		 */
		protected $callback;



		public function __construct ($baseUri, $callback)
		{
			$this->baseUri  = $baseUri;
			$this->callback = $callback;
		}


		/**
		 * @param string $input
		 *
		 * @return bool
		 */
		public function isValid ($uri)
		{
			$parsed = $this->parseRouteString($uri);

			return preg_match('#^' . preg_quote($this->baseUri, '#') . '#', $uri)
					&& $this->getController()->respondsTo($parsed['method'], $parsed['arguments']);
		}


		/**
		 * @param $input
		 *
		 * @return mixed
		 */
		public function execute ($uri)
		{
			$parsed = $this->parseRouteString($uri);
			
			$controller = $this->getController();

			return $controller->dispatch(
				$parsed['method'],
				$parsed['arguments']
			);
		}
		
		
		protected function getController ()
		{
			return call_user_func($this->callback);
		}
	}