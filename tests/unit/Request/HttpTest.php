<?php


	namespace LiftKit\Tests\Unit\Request;

	use LiftKit\Request\Http as HttpRequest;
	use LiftKit\Input\Input;
	use PHPUnit_Framework_TestCase as TestCase;


	class HttpTest extends TestCase
	{
		/**
		 * @var HttpRequest
		 */
		protected $request;


		/**
		 * @var Input
		 */
		protected $get;


		/**
		 * @var Input
		 */
		protected $post;


		/**
		 * @var Input
		 */
		protected $cookie;


		public function setUp ()
		{
			$this->get = new Input(array());
			$this->post = new Input(array());
			$this->cookie = new Input(array());

			$this->request = new HttpRequest(
				array(
					'REQUEST_METHOD' => 'POST',
					'QUERY_STRING'   => 'a=1&b=2',
					'REQUEST_URI'    => '/test?a=1&b=2',
					'REMOTE_ADDR'    => '127.0.0.1',
					'HTTP_HOST'      => 'test.com',
					'HTTPS'          => 'on',
					'SERVER_PORT'    => 80,
				),
				$this->get,
				$this->post,
				$this->cookie
			);
		}


		public function testGetInput ()
		{
			$this->assertSame(
				$this->request->getInput(),
				$this->get
			);

			$this->assertSame(
				$this->request->postInput(),
				$this->post
			);

			$this->assertSame(
				$this->request->cookieInput(),
				$this->cookie
			);
		}


		public function testGetMethod ()
		{
			$this->assertEquals(
				$this->request->getMethod(),
				'POST'
			);
		}


		public function testGetQueryArguments ()
		{
			$this->assertEquals(
				$this->request->getQueryArguments(),
				array(
					'a' => 1,
					'b' => 2,
				)
			);
		}


		public function testGetHost ()
		{
			$this->assertEquals(
				$this->request->getHost(),
				'test.com'
			);
		}


		public function testGetRemoteAddress ()
		{
			$this->assertEquals(
				$this->request->getRemoteAddress(),
				'127.0.0.1'
			);
		}


		public function testGetUri ()
		{
			$this->assertEquals(
				$this->request->getUri(),
				'/test?a=1&b=2'
			);


			$this->assertEquals(
				$this->request->getUri(false),
				'/test'
			);
		}


		public function testIsHttps ()
		{
			$this->assertSame(
				$this->request->isHttps(),
				true
			);
		}


		public function testAsArray ()
		{
			$this->assertEquals(
				$this->request['SERVER_PORT'],
				80
			);
		}
	}