<?php

	require_once(__DIR__ . '/../../bootstrap.php');

	use LiftKit\Application\Hook\Action;


	class Application_Hook_Action_Test extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Action
		 */
		protected $action;


		public function setUp ()
		{
			$this->action = new Action;
		}


		public function testSingleAction ()
		{
			$this->action->bind(function ($input) {
				return $input;
			});

			$testInput = 'test';

			$this->assertEquals(
				$this->action->trigger($testInput),
				$testInput
			);
		}


		public function testMultipleActions ()
		{
			$this->action->bind(function ($input) {
				return $input + 10;
			});

			$this->action->bind(function ($input) {
				return $input + 100;
			});

			$testInput = 1;

			$this->assertEquals(
				$this->action->trigger($testInput),
				111
			);
		}


		public function testPrecedentActions ()
		{
			$this->action->bind(
				function ($input) {
					return $input . 'c';
				},
				1
			);

			$this->action->bind(
				function ($input) {
					return $input . 'b';
				},
				0
			);

			$testInput = 'a';

			$this->assertEquals(
				$this->action->trigger($testInput),
				'abc'
			);
		}
	}