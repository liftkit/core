<?php

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Router\Route\Route;
	use LiftKit\Token\Token;


	abstract class Http extends Route
	{
		/**
		 * @var string
		 */
		protected $baseUri;


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