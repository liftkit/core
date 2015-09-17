<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Router\Route\Http;

	use LiftKit\Router\Route\Route;
	use LiftKit\Request\Request;
	use LiftKit\Response\Response;
	use LiftKit\Token\Token;
	use LiftKit\Controller\Controller;
	use LiftKit\Router\Route\Http\Pattern\Pattern;


	/**
	 * Abstract HTTp Router
	 *
	 * An abstract class to provide utility method to HTTP-oriented routes.
	 *
	 * An HTTP route matches a URI to Controller actions.
	 *
	 * For example, an HTTP route attached to the base URI /example would route the following requests as follows:
	 *
	 *  - '/example'                would be routed to Controller::index()
	 *  - '/example/page'           would be routed to Controller::page()
	 *  - '/example/page/arg1/arg2' would be routed to Controller::page('arg1', 'arg2')
	 *  - '/example/another-page'   would be routed to Controller::anotherPage()
	 * ...
	 *
	 * @package LiftKit\Router\Route\Http
	 */
	abstract class Http extends Route
	{
		/**
		 * Base URI to attach route to
		 *
		 * @var string
		 */
		protected $baseUri;


		/**
		 * @internal
		 *
		 * @param Request $request
		 *
		 * @return array
		 */
		protected function parseRouteRequest (Request $request)
		{
			$baseUri = $this->getBaseUri($request);

			$routeString = preg_replace('#(^' . preg_quote(rtrim($baseUri, '/'), '#') . ')#', '', $request->getUri());

			$routeString = strtok($routeString, '#?');
			$splitRoute = array_filter(explode('/', $routeString));
			$method = array_shift($splitRoute) ?: 'index';
			$methodToken = new Token($method, '-');

			return array(
				'method' => $methodToken->camelcase()->toString(),
				'arguments' => $splitRoute,
			);
		}


		protected function getBaseUri (Request $request)
		{
			if ($this->baseUri instanceof Pattern) {
				$matches = $this->baseUri->matches($request->getUri(), true);

				if ($matches) {
					return $this->baseUri->build($matches);
				} else {
					return null;
				}
			} else {
				return $this->baseUri;
			}
		}


		/**
		 * Returns true if request matches route, false if it doesn't
		 *
		 * @api
		 *
		 * @param Request $request Request Object
		 *
		 * @return bool
		 */
		public function isValid (Request $request)
		{
			$parsed = $this->parseRouteRequest($request);

			return preg_match('#^' . preg_quote(rtrim($this->getBaseUri($request), '/'), '#') . '#', rtrim($request->getUri(), '/'))
				&& $this->getController($request)->respondsTo($parsed['method'], $parsed['arguments']);
		}


		/**
		 * Executes route
		 *
		 * @api
		 *
		 * @param Request $request Request Object
		 *
		 * @return Response
		 */
		public function execute (Request $request)
		{
			$parsed = $this->parseRouteRequest($request);

			$controller = $this->getController($request);

			return $controller->dispatch(
				$parsed['method'],
				$parsed['arguments']
			);
		}


		/**
		 * @internal
		 *
		 * @return Controller
		 */
		abstract protected function getController (Request $request);
	}