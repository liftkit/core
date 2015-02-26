<?php

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Router\Route\Route;
	use LiftKit\Controller\Controller as AbstractController;
	use LiftKit\Token\Token;


	class Controller extends Route
	{
		/**
		 * @var string
		 */
		protected $baseUri;

		/**
		 * @var Controller
		 */
		protected $controller;



		public function __construct ($baseUri, AbstractController $controller)
		{
			$this->baseUri    = $baseUri;
			$this->controller = $controller;
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
					&& $this->controller->respondsTo($parsed['method'], $parsed['arguments']);
		}


		/**
		 * @param $input
		 *
		 * @return mixed
		 */
		public function execute ($uri)
		{
			$parsed = $this->parseRouteString($uri);

			return $this->controller->dispatch(
				$parsed['method'],
				$parsed['arguments']
			);
		}


		protected function parseRouteString ($uri)
		{
			$routeString = preg_replace('#(^' . preg_quote($this->baseUri, '#') . ')#', '', $uri);
			$routeString = strtok($routeString, '#?');

			$splitRoute = array_filter(explode('/', $routeString));
			$method = array_shift($splitRoute) ?: 'index';
			$methodToken = new Token($method, '-');

			return array(
				'method' => $methodToken->camelcase()->toString(),
				'arguments' => $splitRoute,
			);
		}
	}