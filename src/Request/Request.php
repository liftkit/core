<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Request;

	use LiftKit\Input\Input;


	/**
	 * Abstract Request Class
	 *
	 * Extends LiftKit's Input type and serves as the base class for Request objects. Request objects represent the user's requested
	 * action, whether it be an HttpRequest or their command line options.
	 *
	 * @api
	 *
	 * @package LiftKit\Request
	 */
	abstract class Request extends Input
	{

	}