<?php


	namespace LiftKit\Loader\File;

	use LiftKit\Loader\File\Exception\NonexistentFile as NonexistentFileException;
	use LiftKit\Config\Config as ConfigCollection;


	class Config extends Loader
	{


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