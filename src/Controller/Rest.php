<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Controller;

	use LiftKit\Response\Response;


	/**
	 * Abstract base class for REST Controllers
	 *
	 * This class is deprecated and should not be used! Use RestInterface instead.
	 *
	 * @deprecated
	 * @package LiftKit\Controller
	 */
	abstract class Rest extends Controller implements RestInterface
	{


		/**
		 * Index
		 *
		 * Returns an index of resources.
		 *
		 * @return Response
		 */
		abstract public function index ();


		/**
		 * Get
		 *
		 * Returns a single resource.
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		abstract public function get ($id);


		/**
		 * Insert
		 *
		 * Inserts a new resource.
		 *
		 * @return Response
		 */
		abstract public function insert ();


		/**
		 * Update
		 *
		 * Updates an existing resource
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		abstract public function update ($id);


		/**
		 * Delete
		 *
		 * Deletes an existing resource.
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		abstract public function delete ($id);
	}

