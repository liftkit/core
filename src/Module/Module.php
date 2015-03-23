<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Module;

	use LiftKit\DependencyInjection\Container\Container;
	use LiftKit\Module\Exception\NonexistentSubModule as NonexistentSubModuleException;


	/**
	 * Module Class
	 *
	 * Represents a LiftKit module. Each module represents a distinct piece of functionality. The module object is responsible
	 * for initializing resources before a Request is routed. It is recommended at each module be packaged with related Models,
	 * Controllers, etc in its own repository.
	 *
	 * @package LiftKit\Module
	 */
	abstract class Module
	{
		/**
		 * An array of SubModules
		 *
		 * @internal
		 * @var Module[]
		 */
		private $subModules = array();


		/**
		 * Dependency Injection container
		 *
		 * @var Container
		 */
		protected $container;


		/**
		 * Initializes object
		 *
		 * @api
		 * @param Container $container
		 */
		public function __construct (Container $container)
		{
			$this->container = $container;
		}


		/**
		 * Provides instructions for initializing resources and bootstrapping the application. It is recommended that this method delegate
		 * its responsibilities to other more specific methods.
		 *
		 * This method must be implemented in all modules.
		 *
		 * @api
		 */
		abstract public function initialize ();


		/**
		 * This method accepts a fully-qualified class name and creates it.
		 *
		 * @param string $className Fully-qualified class name
		 *
		 * @deprecated It is highly recommended you don't use this method.
		 *
		 * @return Module
		 * @throws NonexistentSubModuleException
		 */
		public function createSubModule ($className)
		{
			if (! class_exists($className) || ! is_subclass_of($className, '\LiftKit\Module\Module')) {
				throw new NonexistentSubModuleException('Class name is not module: ' . $className);
			}

			return new $className($this->container);
		}


		/**
		 * Attaches a Module as a sub module. May be referenced in the future by the module key.
		 *
		 * @api
		 *
		 * @param string $moduleKey A string identifier for future references to the sub module.
		 * @param Module $module    The Module to be attached
		 */
		public function addSubModule ($moduleKey, Module $module)
		{
			$this->subModules[$moduleKey] = $module;
		}


		/**
		 * Returns an array of all sub-modules.
		 *
		 * @api
		 * @see self::addSubModule()
		 *
		 * @return Module[]
		 */
		public function getSubModules ()
		{
			return $this->subModules;
		}


		/**
		 * Returns a single sub-module identified by $moduleKey.
		 *
		 * @param $moduleKey String identifier of module.
		 *
		 * @api
		 * @see self::addSubModule()
		 *
		 * @return Module
		 * @throws NonexistentSubModuleException
		 */
		public function getSubModule ($moduleKey)
		{
			if (isset($this->subModules[$moduleKey])) {
				return $this->subModules[$moduleKey];
			} else {
				throw new NonexistentSubModuleException('No submodule ' . $moduleKey);
			}
		}
	}