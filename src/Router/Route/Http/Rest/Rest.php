<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route\Http\Rest;

	use LiftKit\Router\Route\Http\Http;
	use LiftKit\Request\Request;


	/**
	 * REST HTTP Route
	 *
	 * This class and its decendents map requests to controller actions differently than a normal HTTP route.
	 *
	 * For example, this is how a REST Route attached to /examples would route the following requests:
	 *
	 *  - GET    '/example'   would be routed to Controller::index()
	 *  - GET    '/example/1' would be routed to Controller::get(1)
	 *  - POST   '/example'   would be routed to Controller::insert()
	 *  - POST   '/example/1' would be routed to Controller::update(1)
	 *  - DELETE '/example/1' would be routed to Controller::delete(1)
	 *
	 * @see \LiftKit\Router\Route\Http\Http
	 *
	 * @package LiftKit\Router\Route\Http\Rest
	 */
	abstract class Rest extends Http
	{



		/**
		 * @internal
		 *
		 * @param Request $uri
		 *
		 * @return array
		 */
		protected function parseRouteRequest (Request $request)
		{
			if ($this->getBaseUri($request) === null) {
				return [
					'method' => ' non-existent method ',
				];
			}

			$routeString = preg_replace('#(^' . preg_quote(rtrim($this->getBaseUri($request), '/'), '#') . ')#', '', $request->getUri(false));
			$routeString = strtok($routeString, '#?');
			$routeString = trim($routeString, '/');

			$parsed = parent::parseRouteRequest($request);

			if (
				! in_array($parsed['method'], array('index', 'get', 'insert', 'update', 'delete'))
				&& $this->getController($request)->respondsTo($parsed['method'])
			) {
				return $parsed;

			} else if ($request->getMethod() == 'GET' && preg_match('#^[^/][^/]*$#', $routeString)) {
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
				if (in_array($parsed['method'], array('index', 'get', 'insert', 'update', 'delete'))) {
					$parsed['method'] = ' non-existent method ';
				}

				return $parsed;
			}
		}
	}
