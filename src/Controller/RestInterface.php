<?php

	/**
	 * See the composer.json file for information regarding the authorship and copyright of this file,
	 * or refer to or refer to https://packagist.org/packages/liftkit/core.
	 */


	namespace LiftKit\Controller;

	use LiftKit\Response\Response;


	/**
	 * Interface for REST Controllers
	 *
	 * Defines an interface for Controllers in a REST-based architecture.
	 *
	 * @api
	 *
	 * @package LiftKit\Controller
	 */
	interface RestInterface
	{


		/**
		 * Index
		 *
		 * Return an index of resources.
		 *
		 * @api
		 *
		 * @return Response
		 */
		public function index ();


		/**
		 * Get
		 *
		 * Returns a single resource.
		 *
		 * @api
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		public function get ($id);


		/**
		 * Insert
		 *
		 * Inserts a new resource.
		 *
		 * @api
		 *
		 * @return Response
		 */
		public function insert ();


		/**
		 * Update
		 *
		 * Updates an existing resource
		 *
		 * @api
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		public function update ($id);


		/**
		 * Delete
		 *
		 * Deletes an existing resource.
		 *
		 * @api
		 *
		 * @param mixed $id Identifier of resource
		 *
		 * @return Response
		 */
		public function delete ($id);
	}

