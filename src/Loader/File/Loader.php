<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Loader\File;


	/**
	 * Abstract File Loader
	 *
	 * This class provides an abstraction for loading files, such as views or configuration files.
	 *
	 * @api
	 *
	 * @package LiftKit\Loader\File
	 */
	abstract class Loader
	{
		/**
		 * The base path for files loaded by this class.
		 *
		 * @internal
		 *
		 * @var string
		 */
		private $basePath;


		/**
		 * The suffix for files loaded by this class, most often an extension.
		 *
		 * @internal
		 *
		 * @var string
		 */
		private $suffix;


		/**
		 * Initializes object
		 *
		 * @api
		 *
		 * @param string $basePath
		 * @param string $suffix
		 */
		public function __construct ($basePath = '', $suffix = '')
		{
			$this->basePath = $basePath;
			$this->suffix = $suffix;
		}


		/**
		 * Loads file and returns result.
		 *
		 * @api
		 *
		 * @param string $filePath The path to the file to load. Will be transformed by transformPath()
		 * @param array  $data     Optional data to send to file
		 *
		 * @return mixed
		 */
		abstract public function load ($filePath, $data = array());


		/**
		 * Prepends $basePath and appends $suffix to a path.
		 *
		 * @param string $path
		 *
		 * @return string
		 */
		protected function transformPath ($path)
		{
			return $this->basePath . $path . $this->suffix;
		}
	}