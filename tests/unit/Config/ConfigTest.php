<?php



	namespace LiftKit\Tests\Unit\Config;

	use stdClass;
	use LiftKit\Config\Config;
	use PHPUnit_Framework_TestCase;


	class ConfigTest extends PHPUnit_Framework_TestCase
	{
		/**
		 * @var Config
		 */
		protected $config;


		public function setUp ()
		{
			$this->config = new Config([
				'value1' => 1,
				'value2' => 2,
			]);
		}


		/**
		 * @expectedException \LiftKit\Config\Exception\ExtensionException
		 */
		public function testExtendFails ()
		{
			$obj = new stdClass;
			$obj->value = 3;

			$this->config->extend($obj);
		}


		public function testExtendArray ()
		{
			$this->config->extend([
				'value2' => 0,
				'value3' => 3,
			]);

			$this->assertEquals(
				[
					'value1' => 1,
					'value2' => 0,
					'value3' => 3,
				],
				$this->config->getAll()
			);
		}


		public function testExtendConfig ()
		{
			$this->config->extend(new Config([
				'value2' => 0,
				'value3' => 3,
			]));

			$this->assertEquals(
				[
					'value1' => 1,
					'value2' => 0,
					'value3' => 3,
				],
				$this->config->getAll()
			);
		}
	}