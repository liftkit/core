<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Response;


	/**
	 * Response Object
	 *
	 * This class represents the response to be returned, be it HTML, JSON, or otherwise.
	 *
	 * @package LiftKit\Responses
	 */
	abstract class Response
	{


		/**
		 * __toString function.
		 *
		 * Implicit conversion to string.
		 *
		 * @api
		 * @return string
		 */
		public function __toString ()
		{
			return $this->prepare();
		}


		/**
		 * Prepares the Response to be sent.
		 *
		 * @api
		 *
		 * @return string
		 */
		abstract public function prepare ();


		/**
		 * Renders processed output to stdout.
		 *
		 * @api
		 */
		public function render ()
		{
			echo $this->prepare();
		}
	}