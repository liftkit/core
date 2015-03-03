<?php

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Router\Route\Route;
	use LiftKit\Request\Http as Request;
	use LiftKit\Response\Response;
	use LiftKit\Token\Token;
	use LiftKit\Controller\Controller;


	abstract class Http extends Route
	{
		/**
		 * @var string
		 */
		protected $baseUri;


		/**
		 * @param Request $request
		 *
		 * @return array
		 */
		protected function parseRouteRequest (Request $request)
		{
			$routeString = preg_replace('#(^' . preg_quote($this->baseUri, '#') . ')#', '', $request->getUri());
			$routeString = strtok($routeString, '#?');

			$splitRoute = array_filter(explode('/', $routeString));
			$method = array_shift($splitRoute) ?: 'index';
			$methodToken = new Token($method, '-');

			return array(
				'method' => $methodToken->camelcase()->toString(),
				'arguments' => $splitRoute,
			);
		}


		/**
		 * @param Request $request
		 *
		 * @return bool
		 */
		public function isValid (Request $request)
		{
			$parsed = $this->parseRouteRequest($request);

			return preg_match('#^' . preg_quote($this->baseUri, '#') . '#', $request->getUri())
			&& $this->getController()->respondsTo($parsed['method'], $parsed['arguments']);
		}


		/**
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function execute (Request $request)
		{
			$parsed = $this->parseRouteRequest($request);

			$controller = $this->getController();

			return $controller->dispatch(
				$parsed['method'],
				$parsed['arguments']
			);
		}


		/**
		 * @return Controller
		 */
		abstract protected function getController ();
	}