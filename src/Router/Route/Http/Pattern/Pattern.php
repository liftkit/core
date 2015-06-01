<?php


	namespace LiftKit\Router\Route\Http\Pattern;


	use LiftKit\Router\Route\Http\Pattern\Placeholder\Placeholder;


	class Pattern
	{
		const ALPHA_NUM = '[0-9a-zA-Z]+';
		const SLUG = '[0-9a-zA-Z\-]+';
		const DIGITS = '[0-9]+';

		protected $patternString;
		protected $prefix;
		protected $delimiter;

		/**
		 * @var Placeholder[]
		 */
		protected $placeholders = [];


		public function __construct ($patternString, $prefix = ':', $delimiter = '#')
		{
			$this->patternString = $patternString;
			$this->prefix = $prefix;
			$this->delimiter = $delimiter;
		}


		public function setPlaceholder ($placeholder, $pattern)
		{
			$this->placeholders[] = new Placeholder(
				$placeholder,
				$pattern
			);

			return $this;
		}


		public function build ($args)
		{
			$string = $this->patternString;

			foreach ($args as $key => $value) {
				$string = str_replace($this->prefix . $key, $value, $string);
			}

			return $string;
		}


		public function matches ($string)
		{
			$patternString = preg_quote($this->patternString);

			foreach ($this->placeholders as $placeholder) {
				$pattern = '(?<' . $placeholder->getName() . '>' . $placeholder->getPattern() . ')';
				$patternString = str_replace(preg_quote($this->prefix . $placeholder->getName()), $pattern, $patternString);
			}

			$regex = $this->delimiter . '^' . $patternString . '$' . $this->delimiter;

			if (preg_match($regex, $string, $matches)) {
				return $matches;
			} else {
				return null;
			}
		}
	}