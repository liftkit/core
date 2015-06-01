<?php



	namespace LiftKit\Router\Route\Http\Pattern;

	use LiftKit\Router\Route\Route as BaseRoute;
	use LiftKit\Request\Request;


	class Route extends BaseRoute
	{
		const METHOD_GET = 'GET';
		const METHOD_POST = 'POST';
		const METHOD_PUT = 'PUT';
		const METHOD_DELETE = 'DELETE';
		const METHOD_ANY = '*';

		/**
		 * @var Pattern
		 */
		protected $pattern;


		protected $method;


		public function __construct (Pattern $pattern, callable $callback, $method = self::METHOD_ANY)
		{
			$this->pattern = $pattern;
			$this->method = $method;
			$this->callback = $callback;
		}


		public function isValid (Request $request)
		{
			$methodMatches = ($this->method == self::METHOD_ANY) || ($this->method == $request->getMethod());
			$patternMatches = (bool) $this->pattern->matches($request->getUri(false));

			return $methodMatches && $patternMatches;
		}


		public function execute (Request $request)
		{
			return call_user_func_array(
				$this->callback,
				array($this->pattern->matches($request->getUri(false)), $request)
			);
		}
	}