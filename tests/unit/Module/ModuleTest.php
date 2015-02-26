<?php


	namespace LiftKit\Tests\Unit\Module;

	use LiftKit\Tests\Stub\Module\Module as ModuleStub;
	use LiftKit\DependencyInjection\Container\Container;

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

			$this->module = new ModuleStub($container);
		}


		public function testCreateSubModule ()
		{
			$this->module->createSubModule('\LiftKit\Tests\Stub\Module\Module');
		}


		public function testCreateNonexistentSubModule ()
		{
			$this->setExpectedException('\LiftKit\Module\Exception\NonexistentSubModule');
			$this->module->createSubModule('\LiftKit\No\Such\Module');
		}


		public function testCreateWrongClassSubModule ()
		{
			$this->setExpectedException('\LiftKit\Module\Exception\NonexistentSubModule');
			$this->module->createSubModule('\LiftKit\Controller\Controller');
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