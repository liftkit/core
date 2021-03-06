<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */

	namespace LiftKit\Loader\File;

	use LiftKit\Loader\File\Exception\NonexistentFile as NonexistentFileException;
	use LiftKit\Config\Config as ConfigCollection;


	/**
	 * Config Loader
	 *
	 * Constructs Config objects based on an associative array returned from a file.
	 *
	 * @api
	 *
	 * @package LiftKit\Loader\File
	 */
	class Config extends Loader
	{


		/**
		 * Constructs Config object based on a file. The file must be a PHP file which returns an associative array, which will
		 * initialize the Config object's values.
		 *
		 * @api
		 *
		 * @param string $path Path to file. Beware that this is not an absolute path if you set the basePath or suffix in the constructor.
		 * @param array  $data An associative array of variables to be injected into the file.
		 *
		 * @return ConfigCollection
		 * @throws NonexistentFileException
		 */
		public function load ($path, $data = array())
		{
			extract($data);
			$fullPath = $this->transformPath($path);

			if (is_file($fullPath)) {
				return new ConfigCollection(include($fullPath));
			} else {
				throw new NonexistentFileException('Script not found: ' . $fullPath);
			}
		}
	}