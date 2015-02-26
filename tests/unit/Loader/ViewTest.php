<?php


	namespace LiftKit\Tests\Unit\Loader;
	
	use LiftKit\Loader\View as ViewLoader;
	use LiftKit\Response\View;
	use PHPUnit_Framework_TestCase;
	
	
	class ViewTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ScriptLoader
		 */
		protected $loader;
		
		
		
		public function setUp ()
		{
			$this->loader = new ViewLoader(dirname(dirname(__DIR__)) . '/views/', '.php');
		}
		
		
		public function testFailsToLoadFile ()
		{
			$this->setExpectedException('\LiftKit\Loader\Exception\NonexistentFile');
			$this->loader->loadFile('no-file');
		}
		
		
		public function testLoadFile ()
		{
			$view = $this->loader->loadFile('test', array('message' => 'test'));
			
			$this->assertTrue($view instanceof View);
			$this->assertEquals((string) $view, 'test');
		}
	}