<?php


	namespace LiftKit\Loader\File;
	
	
	abstract class Loader
	{
		protected $basePath;
		protected $suffix;
		
		
		public function __construct ($basePath = '', $suffix = '')
		{
			$this->basePath = $basePath;
			$this->suffix = $suffix;
		}
		
		
		abstract public function load ($filePath, $data = array());
		
		
		protected function transformPath ($path)
		{
			return $this->basePath . $path . $this->suffix;
		}
	}