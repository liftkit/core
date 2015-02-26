<?php


	namespace LiftKit\Module;

	use LiftKit\Loader\File\Script as ScriptLoader;
	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Module\Exception\NonexistentSubModule as NonexistentSubModuleException;


	abstract class Module
	{
		/**
		 * @var Module[]
		 */
		private $subModules = array();


		/**
		 * @var ScriptLoader
		 */
		protected $scriptLoader;


		/**
		 * @var Container
		 */
		protected $container;


		public function __construct (Container $container, ScriptLoader $scriptLoader)
		{
			$this->container = $container;
			$this->scriptLoader = $scriptLoader;

			$this->initialize();
		}


		abstract public function initialize ();


		/**
		 * @param $className
		 *
		 * @return Module
		 * @throws NonexistentSubModuleException
		 */
		public function createSubModule ($className)
		{
			if (! class_exists($className) || ! is_subclass_of($className, '\LiftKit\Module\Module')) {
				throw new NonexistentSubModuleException('Class name is not module: ' . $className);
			}

			return new $className($this->container, $this->scriptLoader);
		}


		public function addSubModule ($moduleKey, Module $module)
		{
			$this->subModules[$moduleKey] = $module;
		}


		public function getSubModules ()
		{
			return $this->subModules;
		}


		public function getSubModule ($moduleKey)
		{
			if (isset($this->subModules[$moduleKey])) {
				return $this->subModules[$moduleKey];
			} else {
				throw new NonexistentSubModuleException('No submodule ' . $moduleKey);
			}
		}
	}