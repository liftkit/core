<?php


	namespace LiftKit\Controller;


	/**
	 * Class Rest
	 *
	 * @package LiftKit\Controller
	 */
	abstract class Rest extends Controller
	{

		abstract public function index ();
		abstract public function get ($id);

		abstract public function insert ();
		abstract public function update ($id);

		abstract public function delete ($id);
	}

