<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */

	namespace LiftKit\Response;


	/**
	 * Class Response
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
		 * @access public
		 * @return string
		 */
		public function __toString ()
		{
			return $this->prepare();
		}


		/**
		 * @access public
		 * @return string
		 */
		abstract public function prepare ();


		/**
		 * render function.
		 *
		 * Renders processed output to stdout.
		 *
		 * @access public
		 * @return void
		 */
		public function render ()
		{
			echo $this->prepare();
		}
	}