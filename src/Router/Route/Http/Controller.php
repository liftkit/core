<?php

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Controller\Controller as AbstractController;


	class Controller extends Http
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