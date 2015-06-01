<?php

	namespace LiftKit\Tests\Unit\Router\Route\Http\Pattern\Placeholder;

	use LiftKit\Router\Route\Http\Pattern\Pattern;
	use PHPUnit_Framework_TestCase;


	class PatternTest extends PHPUnit_Framework_TestCase
	{


		public function testMatches ()
		{
			$pattern = new Pattern('/base/path/:arg1/:arg2');

			$pattern->setPlaceholder('arg1', Pattern::ALPHA_NUM);
			$pattern->setPlaceholder('arg2', Pattern::DIGITS);

			$this->assertNull($pattern->matches('/base/path'));
			$this->assertNull($pattern->matches('/base/path/id/123/123'));
			$this->assertNull($pattern->matches('/base/path/id/a1'));

			$matches = $pattern->matches('/base/path/id/123');

			$this->assertEquals('id', $matches['arg1']);
			$this->assertEquals('123', $matches['arg2']);
		}


		public function testBuild ()
		{
			$pattern = new Pattern('/base/path/:arg1/:arg2');

			$pattern->setPlaceholder('arg1', Pattern::ALPHA_NUM);
			$pattern->setPlaceholder('arg2', Pattern::DIGITS);

			$this->assertEquals(
				'/base/path/id/123',
				$pattern->build([
					'arg1' => 'id',
					'arg2' => 123
				])
			);
		}


		public function testAlphaNum ()
		{
			$pattern  = '#^' . Pattern::ALPHA_NUM . '$#';
			preg_match($pattern, 'fails$', $matches);

			$this->assertNull($matches[0]);

			$pattern  = '#^' . Pattern::ALPHA_NUM . '$#';
			preg_match($pattern, 'Asdf12345', $matches);

			$this->assertEquals('Asdf12345', $matches[0]);
		}


		public function testDigits ()
		{
			$pattern  = '#^' . Pattern::DIGITS . '$#';
			preg_match($pattern, 'fails', $matches);

			$this->assertNull($matches[0]);

			$pattern  = '#^' . Pattern::DIGITS . '$#';
			preg_match($pattern, '12345', $matches);

			$this->assertEquals('12345', $matches[0]);
		}


		public function testSlug ()
		{
			$pattern  = '#^' . Pattern::SLUG . '$#';
			preg_match($pattern, 'fails$', $matches);

			$this->assertNull($matches[0]);

			$pattern  = '#^' . Pattern::SLUG . '$#';
			preg_match($pattern, 'Asdf-12345', $matches);

			$this->assertEquals('Asdf-12345', $matches[0]);
		}
	}