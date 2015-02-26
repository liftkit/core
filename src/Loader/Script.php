<?php


	namespace LiftKit\Loader;
	
	use LiftKit\Loader\Exception\NonexistentFile as NonexistentFileException;
	
	
	class Script extends Loader
	{
		
		
		public function loadFile ($path, $data = array())
		{
			extract($data);
			$fullPath = $this->transformPath($path);
			
			if (is_file($fullPath)) {
				return include($fullPath);
			} else {
				throw new NonexistentFileException('Script not found: ' . $fullPath);
			}
		}
	}