<?php


	require_once(__DIR__ . '/../../bootstrap.php');


	use LiftKit\Router\Route\Regex as RegexRoute;


	class Router_Route_Regex_Test extends PHPUnit_Framework_TestCase
	{


		public function setUp ()
		{
		}


		/**
		 * @expectedException     \LiftKit\Router\Route\Exception\Route
		 */
		public function testIncorrectCallback ()
		{
			new RegexRoute(
				function () {},
				'bad input'
			);
		}


		public function testIsValid ()
		{
			$route = new RegexRoute(
				'#^test$#',
				function ()
				{
					// No operation
				}
			);

			$this->assertSame(
				$route->isValid('test'),
				true
			);

			$this->assertSame(
				$route->isValid('test1'),
				false
			);

			$this->assertSame(
				$route->isValid('tes'),
				false
			);
		}


		public function testExecute ()
		{
			$route = new RegexRoute(
				'#^/(.*?)/(.*)#',
				function ($matches)
				{
					return $matches;
				}
			);

			$this->assertEquals(
				$route->execute('/seg1/seg2'),
				array(
					0 => '/seg1/seg2',
					1 => 'seg1',
					2 => 'seg2',
				)
			);
		}
	}