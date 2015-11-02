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
			if (! $this->isExtendable($values)) {
				throw new ExtensionException('Invalid extended value type.');
			}

			$this->extendRecurse($values, $this->items);

			return $this;
		}


		private function extendRecurse (& $newValues, & $oldValues)
		{
			foreach ($newValues as $key => $newValue) {
				$isExtendable = $this->isExtendable($newValue) && $this->isExtendable($oldValues[$key]);
				$notExtendable = (! $this->isExtendable($newValue) && ! $this->isExtendable($oldValues[$key]));

				if ($isExtendable) {
					$this->extendRecurse($newValue, $oldValues[$key]);
				} else if ($notExtendable) {
					$oldValues[$key] = $newValue;
				} else {
					throw new ExtensionException('Type mismatch in extended value.');
				}
			}
		}


		private function isExtendable ($value)
		{
			return ($value instanceof self || is_array($value));
		}
	}