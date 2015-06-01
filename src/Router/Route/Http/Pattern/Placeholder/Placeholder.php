<?php


	namespace LiftKit\Router\Route\Http\Pattern\Placeholder;


	class Placeholder
	{
		protected $name;
		protected $pattern;


		public function __construct ($name, $pattern)
		{
			$this->name = $name;
			$this->pattern = $pattern;
		}


		public function getName ()
		{
			return $this->name;
		}


		public function getPattern ()
		{
			return $this->pattern;
		}
	}