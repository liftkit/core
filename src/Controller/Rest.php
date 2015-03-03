<?php


	namespace LiftKit\Controller;


	/**
	 * Class Rest
	 *
	 * @package LiftKit\Controller
	 */
	abstract class Rest extends Controller
	{


		abstract public function get ($id);
		abstract public function getAll ();

		abstract public function postInsert ();
		abstract public function postUpdate ($id);

		abstract public function delete ($id);
	}

