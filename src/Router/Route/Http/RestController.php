<?php

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Controller\Rest as AbstractController;


	class Controller extends Http
	{
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
	}