<?php


	use LiftKit\Controller\Controller;
	use LiftKit\Response\String;


	class Controller_Controller_Mock extends Controller
	{



		public function actionMethod ()
		{
			return 'here';
		}


		public function invalidResponse ()
		{
			return null;
		}


		public function validStringResponse ()
		{
			return 'valid response';
		}


		public function validObjectResponse ()
		{
			return new String('valid response');
		}
	}