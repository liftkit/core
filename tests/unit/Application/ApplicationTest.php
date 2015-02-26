<?php

	namespace LiftKit\Tests\Unit\Application;

	use LiftKit\Application\Application;
	use LiftKit\Application\Hook\Event;
	
	use PHPUnit_Framework_TestCase;


	class ApplicationTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Application
		 */
		protected $application;


		public function setUp ()
		{
			$this->application = new Application;
		}


		/**
		 * @expectedException \LiftKit\Application\Exception\UnregisteredHook
		 */
		public function testBindUnregisteredHook ()
		{
			$this->application->bindHook('nonexistent', function () {});
		}


		public function testBindRegisteredHook ()
		{
			$this->application->registerHook('testHook', new Event);
			$this->application->bindHook('testHook', function () {});
		}


		/**
		 * @expectedException \LiftKit\Application\Exception\ReregisterHook
		 */
		public function testReregisterHookException ()
		{
			$this->application->registerHook('testHook', new Event);
			$this->application->registerHook('testHook', new Event);
		}


		/**
		 * @expectedException \LiftKit\Application\Exception\InvalidHookIdentifier
		 */
		public function testInvalidHookException ()
		{
			$this->application->registerHook('', new Event);
		}
	}