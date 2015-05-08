<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Request;

	use LiftKit\Input\Input;


	/**
	 * HTTP Request
	 *
	 * This class represents an HTTP Request
	 *
	 * @package LiftKit\Request
	 */
	class Http extends Request
	{
		/**
		 * @internal
		 *
		 * @var Input
		 */
		private $get;


		/**
		 * @internal
		 *
		 * @var Input
		 */
		private $post;


		/**
		 * @internal
		 *
		 * @var Input
		 */
		private $cookie;


		/**
		 * @internal
		 *
		 * @var Input
		 */
		private $files;


		/**
		 * Initialize object
		 *
		 * @api
		 *
		 * @param array $data   Data from the $_SERVER array
		 * @param Input $get    Input object generated from the $_GET array
		 * @param Input $post   Input object generated from the $_POST array
		 * @param Input $cookie Input object generated from the $_COOKIE array
		 */
		public function __construct ($data, Input $get = null, Input $post = null, Input $cookie = null, Input $files = null)
		{
			parent::__construct($data);

			$this->get    = $get;
			$this->post   = $post;
			$this->cookie = $cookie;
			$this->files  = $files;
		}


		/**
		 * Retrieves the Input object representing the $_GET array
		 *
		 * @api
		 *
		 * @return Input
		 */
		public function getInput ()
		{
			return $this->get;
		}


		/**
		 * Retrieves the Input object representing the $_POST array
		 *
		 * @api
		 *
		 * @return Input
		 */
		public function postInput ()
		{
			return $this->post;
		}


		/**
		 * Retrieves the Input object representing the $_COOKIE array
		 *
		 * @api
		 *
		 * @return Input
		 */
		public function cookieInput ()
		{
			return $this->cookie;
		}


		/**
		 * Retrieves the Input object representing the $_FILES array
		 *
		 * @api
		 *
		 * @return Input
		 */
		public function filesInput ()
		{
			return $this->files;
		}


		/**
		 * Returns the REQUEST_METHOD server variable
		 *
		 * @api
		 *
		 * @return string
		 */
		public function getMethod ()
		{
			return $this->offsetGet('REQUEST_METHOD');
		}


		/**
		 * Returns an associative array of arguments from the query string
		 *
		 * @api
		 *
		 * @return array
		 */
		public function getQueryArguments ()
		{
			parse_str($this->offsetGet('QUERY_STRING'), $args);

			return $args;
		}


		/**
		 * Returns the HTTP_HOST server variable
		 *
		 * @api
		 *
		 * @return string
		 */
		public function getHost ()
		{
			return $this->offsetGet('HTTP_HOST');
		}


		/**
		 * Returns the REMOTE_ADDR server variable
		 *
		 * @api
		 *
		 * @return string
		 */
		public function getRemoteAddress ()
		{
			return $this->offsetGet('REMOTE_ADDR');
		}


		/**
		 * Returns whether a request was made via HTTPS protocol
		 *
		 * @api
		 *
		 * @return bool
		 */
		public function isHttps ()
		{
			return (bool) $this->offsetGet('HTTPS');
		}


		/**
		 * Returns the request URI
		 *
		 * @api
		 *
		 * @param bool $includeQueryString If true, the query string will be included in the return value
		 *
		 * @return string
		 */
		public function getUri ($includeQueryString = true)
		{
			if ($includeQueryString) {
				return $this->offsetGet('REQUEST_URI');
			} else {
				return strtok($this->offsetGet('REQUEST_URI'), '?#');
			}
		}


		/**
		 * Gets file at offset "name"
		 *
		 * @api
		 *
		 * @param string $name Offset of file in files array
		 */
		public function getFile ($name)
		{
			return $this->files[$name];
		}
	}