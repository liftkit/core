<?php


	namespace LiftKit\Request;

	use LiftKit\Input\Input;



	class Http extends Request
	{
		/**
		 * @var Input
		 */
		protected $get;


		/**
		 * @var Input
		 */
		protected $post;


		/**
		 * @var Input
		 */
		protected $cookie;


		public function __construct ($data, Input $get = null, Input $post = null, Input $cookie = null)
		{
			parent::__construct($data);

			$this->get = $get;
			$this->post = $post;
			$this->cookie = $cookie;
		}


		public function getInput ()
		{
			return $this->get;
		}


		public function postInput ()
		{
			return $this->post;
		}


		public function cookieInput ()
		{
			return $this->cookie;
		}


		public function getMethod ()
		{
			return $this->offsetGet('REQUEST_METHOD');
		}


		public function getQueryArguments ()
		{
			parse_str($this->offsetGet('QUERY_STRING'), $args);

			return $args;
		}


		public function getHost ()
		{
			return $this->offsetGet('HTTP_HOST');
		}


		public function getRemoteAddress ()
		{
			return $this->offsetGet('REMOTE_ADDR');
		}


		public function isHttps ()
		{
			return (bool) $this->offsetGet('HTTPS');
		}


		public function getUri ($includeQueryString = true)
		{
			if ($includeQueryString) {
				return $this->offsetGet('REQUEST_URI');
			} else {
				return strtok($this->offsetGet('REQUEST_URI'), '?#');
			}
		}
	}