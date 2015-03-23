<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Application\Exception;

	use Exception;


	/**
	 * Class UnregisteredHook
	 *
	 * This exception indicated that an attempt to bind or trigger an unregistered hook was made.
	 *
	 * @package LiftKit\Application\Exception
	 */
	class UnregisteredHook extends Exception
	{

	}