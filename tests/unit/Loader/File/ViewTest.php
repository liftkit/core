<?php


	namespace LiftKit\Tests\Unit\Loader\File;
	
	use LiftKit\Loader\File\View as ViewLoader;
	use LiftKit\Response\View;
	use PHPUnit_Framework_TestCase;
	
	
	class ViewTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ViewLoader
		 */
		protected $loader;
		
		
		
		public function setUp ()
		{
			$this->loader = new ViewLoader(dirname(dirname(dirname(__DIR__))) . '/views/', '.php');
		}
		
		
		public function testFailsToLoadFile ()
		{
			$this->setExpectedException('\LiftKit\Loader\File\Exception\NonexistentFile');
			$this->loader->load('no-file');
		}
		
		
		public function testLoadFile ()
		{
			$view = $this->loader->load('test', array('message' => 'test'));
			
			$this->assertTrue($view instanceof View);
			$this->assertEquals((string) $view, 'test');
		}
	}