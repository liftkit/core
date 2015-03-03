<?php


	namespace LiftKit\Router\Route\Http\Rest;

	use LiftKit\Router\Route\Http\Http;
	use LiftKit\Request\Http as Request;


	abstract class Rest extends Http
	{



		/**
		 * @param Request $uri
		 *
		 * @return array
		 */
		protected function parseRouteRequest (Request $request)
		{
			$routeString = preg_replace('#(^' . preg_quote($this->baseUri, '#') . ')#', '', $request->getUri());
			$routeString = strtok($routeString, '#?');
			$routeString = trim($routeString, '/');

			if ($request->getMethod() == 'GET' && preg_match('#^[^/][^/]*$#', $routeString)) {
				return array(
					'method' => 'get',
					'arguments' => array_filter(explode('/', $routeString)),
				);

			} else if ($request->getMethod() == 'GET' && $routeString == '') {
				return array(
					'method'    => 'index',
					'arguments' => array()
				);

			} else if ($request->getMethod() == 'DELETE' && preg_match('#^[^/][^/]*$#', $routeString)) {
				return array(
					'method'    => 'delete',
					'arguments' => array_filter(explode('/', $routeString)),
				);

			} else if ($request->getMethod() == 'POST' && preg_match('#^[^/][^/]*$#', $routeString)) {
				return array(
					'method'    => 'update',
					'arguments' => array_filter(explode('/', $routeString)),
				);

			} else if ($request->getMethod() == 'POST' && $routeString == '') {
				return array(
					'method'    => 'insert',
					'arguments' => array()
				);

			} else {
				$parsed = parent::parseRouteRequest($request);

				if (in_array($parsed['method'], array('index', 'get', 'insert', 'update', 'delete'))) {
					$parsed['method'] = ' non-existent method ';
				}

				return $parsed;
			}
		}
	}