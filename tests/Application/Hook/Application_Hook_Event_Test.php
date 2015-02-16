<?php

	require_once(__DIR__ . '/../../bootstrap.php');

	use LiftKit\Application\Hook\Event;


	class Application_Hook_Event_Test extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Event
		 */
		protected $event;


		public function setUp ()
		{
			$this->event = new Event;
		}


		public function testSingleEvent ()
		{
			$this->event->bind(function ($input) {
				return $input;
			});

			$this->assertEquals(
				$this->event->trigger(array('test')),
				array('test')
			);
		}


		public function testMultipleActions ()
		{
			$this->event->bind(function ($input) {
				return $input + 10;
			});

			$this->event->bind(function ($input) {
				return $input + 100;
			});

			$this->assertEquals(
				$this->event->trigger(array(1)),
				array(11, 101)
			);
		}


		public function testPrecedentActions ()
		{
			$this->event->bind(
				function ($input) {
					return $input . 'c';
				},
				1
			);

			$this->event->bind(
				function ($input) {
					return $input . 'b';
				},
				0
			);

			$this->assertEquals(
				$this->event->trigger(array('a')),
				array('ab', 'ac')
			);
		}
	}