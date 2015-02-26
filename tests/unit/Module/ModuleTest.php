<?php


	namespace LiftKit\Tests\Unit\Module;

	use LiftKit\Tests\Stub\Module\Module as ModuleStub;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Loader\File\Script as ScriptLoader;

	use PHPUnit_Framework_TestCase;


	class ModuleTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var ModuleStub
		 */
		protected $module;


		public function setUp ()
		{
			$container = new Container;
			$scriptLoader = new ScriptLoader;

			$this->module = new ModuleStub($container, $scriptLoader);
		}


		public function testCreateSubModule ()
		{
			$subModule = $this->module->createSubModule('\LiftKit\Tests\Stub\Module\Module');
			$subModule->initialize();
		}


		public function testCreateNonexistentSubModule ()
		{
			$this->setExpectedException('\LiftKit\Module\Exception\NonexistentSubModule');
			$subModule = $this->module->createSubModule('\LiftKit\No\Such\Module');
			$subModule->initialize();
		}


		public function testCreateWrongClassSubModule ()
		{
			$this->setExpectedException('\LiftKit\Module\Exception\NonexistentSubModule');
			$subModule = $this->module->createSubModule('\LiftKit\Controller\Controller');
			$subModule->initialize();
		}


		public function testAddGetSubModule ()
		{
			$subModuleA = $this->module->createSubModule('\LiftKit\Tests\Stub\Module\Module');
			$subModuleB = $this->module->createSubModule('\LiftKit\Tests\Stub\Module\Module');

			$this->module->addSubModule('ModuleA', $subModuleA);
			$this->module->addSubModule('ModuleB', $subModuleB);

			$this->assertSame(
				$this->module->getSubModule('ModuleA'),
				$subModuleA
			);

			$this->assertSame(
				$this->module->getSubModules(),
				array(
					'ModuleA' => $subModuleA,
					'ModuleB' => $subModuleB,
				)
			);

			$this->setExpectedException('\LiftKit\Module\Exception\NonexistentSubModule');
			$this->module->getSubModule('ModuleC');
		}
	}