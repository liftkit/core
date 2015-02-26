<?php


	namespace LiftKit\Tests\Unit\Loader\File;

	use LiftKit\Loader\File\Config as ConfigLoader;
	use LiftKit\Config\Config;
	use PHPUnit_Framework_TestCase;


	class ConfigTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ConfigLoader
		 */
		protected $loader;



		public function setUp ()
		{
			$this->loader = new ConfigLoader(dirname(dirname(dirname(__DIR__))) . '/config/', '.php');
		}


		public function testFailsToLoadFile ()
		{
			$this->setExpectedException('\LiftKit\Loader\File\Exception\NonexistentFile');
			$this->loader->load('no-file');
		}


		public function testLoadFile ()
		{
			$config = $this->loader->load('test');

			$this->assertTrue($config instanceof Config);
			$this->assertEquals($config->toArray(), array('test1' => 1, 'test2' => 2));
		}
	}