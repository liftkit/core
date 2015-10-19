<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Config;

	use LiftKit\Collection\Collection;
	use LiftKit\Config\Exception\ExtensionException;


	/**
	 * Class Config
	 *
	 * This is a container class for configuration variables. It extends LiftKit's Collection class, which provides the ArrayAccess and
	 * Iterator interfaces.
	 *
	 * @see Collection
	 *
	 * @package LiftKit\Config
	 */
	class Config extends Collection
	{



		public function extend ($values)
		{
			if (is_array($values)) {
				$this->items = array_merge($this->items, $values);
			} else if ($values instanceof self) {
				$this->items = array_merge($this->items, $values->items);
			} else {
				throw new ExtensionException('You may only extend a Config object with another config object or an array!');
			}

			return $this;
		}
	}