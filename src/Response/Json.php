<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Response;


	/**
	 * Class Json
	 *
	 * @package LiftKit\Response
	 */
	class Json extends Response
	{
		protected $jsonData;


		public function __construct ($data, $mode = 0)
		{
			$this->jsonData = json_encode($data, $mode);
		}


		public function prepare ()
		{
			return $this->jsonData;
		}
	}