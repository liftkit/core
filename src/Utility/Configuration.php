<?php

	/*
	 *
	 *	LiftKit MVC PHP Framework
	 *
	 */


	namespace LiftKit\Utility;

	use LiftKit\Utility\Exception\Configuration as ConstantException;


	class Configuration
	{
		/**
		 * @var array
		 */
		protected static $items = array();


		/**
		 * @param string $key
		 *
		 * @throws ConstantException
		 * @return mixed
		 */
		public static function get ($key)
		{
			if (isset(self::$items[$key])) {
				return self::$items[$key];
			} else {
				throw new ConstantException('No constant ' . $key . ' set.');
			}
		}


		/**
		 * @param string $key
		 * @param mixed $item
		 * @param bool $forceOverwrite (default: false)
		 *
		 * @throws ConstantException
		 */
		public static function set ($key, $item, $forceOverwrite = false)
		{
			if (! isset(self::$items[$key]) || $forceOverwrite) {
				self::$items[$key] = $item;
			} else {
				throw new ConstantException('Failed attempt to redefine constant parameter: '.$key);
			}
		}
	}