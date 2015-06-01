<?php

	namespace LiftKit\Tests\Unit\Router\Route\Http\Pattern\Placeholder;

	use LiftKit\Router\Route\Http\Pattern\Placeholder\Placeholder;
	use PHPUnit_Framework_TestCase;


	class PlaceholderTest extends PHPUnit_Framework_TestCase
	{


		public function testPlaceholder ()
		{
			$placeholder = new Placeholder('placeholder', 'pattern');

			$this->assertEquals('placeholder', $placeholder->getName());
			$this->assertEquals('pattern', $placeholder->getPattern());
		}
	}