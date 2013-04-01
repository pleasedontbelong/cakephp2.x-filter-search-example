<?php
App::uses('Director', 'Model');

/**
 * Director Test Case
 *
 */
class DirectorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.director'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Director = ClassRegistry::init('Director');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Director);

		parent::tearDown();
	}

}
