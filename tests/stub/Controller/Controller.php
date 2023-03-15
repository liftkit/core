<?php


	namespace LiftKit\Tests\Stub\Controller;

	use LiftKit\Controller\Controller as AbstractController;
	use LiftKit\Response\StringResponse;


	class Controller extends AbstractController
	{


		public function index ()
		{
			return 'index';
		}


		public function test ()
		{
			return 'test';
		}


		public function methodWithArg ($arg)
		{
			return $arg;
		}


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
			return new StringResponse('valid response');
		}
	}
