<?php


	namespace LiftKit\Controller;


	interface RestInterface
	{

		public function index ();
		public function get ($id);

		public function insert ();
		public function update ($id);

		public function delete ($id);
	}

