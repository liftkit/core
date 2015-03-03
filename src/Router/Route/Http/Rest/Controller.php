<?php

	namespace LiftKit\Router\Route\Http\Rest;

	use LiftKit\Controller\Rest as AbstractController;


	class Controller extends Rest
	{
		/**
		 * @var AbstractController
		 */
		protected $controller;



		public function __construct ($baseUri, AbstractController $controller)
		{
			$this->baseUri    = $baseUri;
			$this->controller = $controller;
		}


		public function getController ()
		{
			return $this->controller;
		}
	}