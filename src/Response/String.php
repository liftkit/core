<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */

	namespace LiftKit\Response;


	class String extends Response
	{
		protected $string;


		/**
		 * @param string $string
		 */
		public function __construct ($string)
		{
			$this->string = (string) $string;
		}


		/**
		 * @access public
		 * @return string
		 */
		public function prepare ()
		{
			return $this->string;
		}
	}