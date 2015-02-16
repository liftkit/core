<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Response;

	use LiftKit\Response\Exception\ViewFileNotFound as ViewFileNotFoundException;


	/**
	 * Class View
	 *
	 * @package LiftKit\Responses
	 */
	class View extends Response
	{
		protected $filePath;
		protected $viewData = array();


		/**
		 * __construct function.
		 *
		 * Sets file and loaded data.
		 *
		 * @access public
		 *
		 * @param string $file
		 * @param array  $data (default: array())
		 *
		 * @return void
		 */
		public function __construct ($file, $data = array())
		{
			$this->filePath = $file;
			$this->viewData = (array)$data;
		}


		/**
		 * getData function.
		 *
		 * Returns field from data or all fields as object.
		 *
		 * @access public
		 *
		 * @param mixed $field (default: null)
		 */

		public function getData ($field = null)
		{
			if ($field) {
				return $this->viewData[$field];
			} else {
				return $this->viewData;
			}
		}


		/**
		 * prepare function.
		 *
		 * Returns string of template pointed to by file, with data passed to it.
		 *
		 * @access public
		 * @return string
		 */
		public function prepare ()
		{
			if (is_array($this->viewData)) {
				foreach ($this->viewData as $token => $value) {
					if (is_object($value) && is_subclass_of($value, __CLASS__)) {
						$$token = $value->prepare();
					} else {
						$$token = $value;
					}
				}
			}

			if (is_file($this->filePath)) {
				ob_start();
				require($this->filePath);

				return ob_get_clean();

			} else {
				throw new ViewFileNotFoundException('No such view: ' . $this->filePath);
			}
		}


		/**
		 * setData function.
		 *
		 * Sets data by key => value pair or by array/object.
		 *
		 * @access public
		 *
		 * @param mixed  $arg1
		 * @param string $arg2 (default: null)
		 *
		 * @return self
		 */
		public function setData ($arg1, $arg2 = null)
		{
			if (is_array($arg1) || is_object($arg1)) {
				$this->viewData = array_merge($this->viewData, (array)$arg1);
			} else {
				$this->viewData[$arg1] = $arg2;
			}

			return $this;
		}


		/**
		 * unsetData function.
		 *
		 * Unsets data either by field or all fields
		 *
		 * @access public
		 *
		 * @param mixed $field
		 *
		 * @return self
		 */
		public function unsetData ($field = null)
		{
			if ($field) {
				unset($this->viewData[$field]);
			} else {
				$this->viewData = array();
			}

			return $this;
		}
	}