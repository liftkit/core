<?php


	namespace LiftKit\Loader\File;
	
	use LiftKit\Loader\File\Exception\NonexistentFile as NonexistentFileException;
	use LiftKit\Response\View as ViewResponse;
	
	
	class View extends Loader
	{
		
		
		public function load ($path, $data = array())
		{
			$fullPath = $this->transformPath($path);
			
			if (is_file($fullPath)) {
				return new ViewResponse($fullPath, $data);
			} else {
				throw new NonexistentFileException('View not found: ' . $fullPath);
			}
		}
	}