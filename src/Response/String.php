<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Response;


	/**
	 * String Response
	 *
	 * This class represents a simple string response.
	 *
	 * @api
	 *
	 * @package LiftKit\Response
	 */
	class String extends Response
	{
		/**
		 * @internal
		 *
		 * @var string
		 */
		private $string;


		/**
		 * Constructor
		 *
		 * @param string $string
		 */
		public function __construct ($string)
		{
			$this->string = (string) $string;
		}


		/**
		 * Prepares the string to be rendered.
		 *
		 * @internal
		 *
		 * @return string
		 */
		public function prepare ()
		{
			return $this->string;
		}
	}