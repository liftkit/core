<?php

	
	namespace LiftKit\Tests\Stub\Controller;

	use LiftKit\Controller\Controller as AbstractController;
	use LiftKit\Response\String;


	class Controller extends AbstractController
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