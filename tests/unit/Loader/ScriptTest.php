<?php


	namespace LiftKit\Tests\Unit\Loader;
	
	use LiftKit\Loader\Script as ScriptLoader;
	use PHPUnit_Framework_TestCase;
	
	
	class ScriptTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ScriptLoader
		 */
		protected $loader;
		
		
		
		public function setUp ()
		{
			$this->loader = new ScriptLoader(dirname(dirname(__DIR__)) . '/', '.php');
		}
		
		
		public function testFailsToLoadFile ()
		{
			$this->setExpectedException('\LiftKit\Loader\Exception\NonexistentFile');
			$this->loader->loadFile('scripts/no-file');
		}
		
		
		public function testLoadFile ()
		{
			$this->assertEquals(
				$this->loader->loadFile('scripts/test', array('message' => 'test')),
				'test'
			);
		}
	}