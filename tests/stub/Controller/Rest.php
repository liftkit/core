<?php



	namespace LiftKit\Tests\Stub\Controller;

	use LiftKit\Controller\Rest as RestController;


	class Rest extends RestController
	{


		public function index ()
		{
			return 'index';
		}


		public function get ($id)
		{
			return 'get: ' . $id;
		}


		public function insert ()
		{
			return 'insert';
		}


		public function update ($id)
		{
			return 'update: ' . $id;
		}


		public function delete ($id)
		{
			return 'delete: ' . $id;
		}


		public function example ()
		{
			return 'example';
		}
	}