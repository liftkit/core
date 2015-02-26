<?php


	namespace LiftKit\Tests\Unit\Loader\File;
	
	use LiftKit\Loader\File\Script as ScriptLoader;
	use PHPUnit_Framework_TestCase;
	
	
	class ScriptTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ScriptLoader
		 */
		protected $loader;
		
		
		
		public function setUp ()
		{
			$this->loader = new ScriptLoader(dirname(dirname(dirname(__DIR__))) . '/', '.php');
		}
		
		
		public function testFailsToLoadFile ()
		{
			$this->setExpectedException('\LiftKit\Loader\File\Exception\NonexistentFile');
			$this->loader->load('scripts/no-file');
		}
		
		
		public function testLoadFile ()
		{
			$this->assertEquals(
				$this->loader->load('scripts/test', array('message' => 'test')),
				'test'
			);
		}
	}