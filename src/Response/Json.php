<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Response;

	use JsonSerializable;


	/**
	 * JSON Response
	 *
	 * Represents a response in JSON format.
	 *
	 * @package LiftKit\Response
	 */
	class Json extends Response implements JsonSerializable
	{
		/**
		 * @internal
		 *
		 * @var string
		 */
		private $data;


		private $mode;


		/**
		 * Constructor
		 *
		 * @api
		 *
		 * @param mixed $data element you'd like to encode
		 * @param int   $mode json_encode options constant
		 *
		 * @link http://php.net/manual/en/function.json-encode.php json_encode documentation
		 */
		public function __construct ($data, $mode = 0)
		{
			$this->data = $data;
			$this->mode = $mode;
		}


		/**
		 * Returns JSON data as string
		 *
		 * @internal
		 *
		 * @return string
		 */
		public function prepare ()
		{
			return json_encode($this->data, $this->mode);
		}


		#[ReturnTypeWillChange]
		public function jsonSerialize ()
		{
			return $this->data;
		}
	}
