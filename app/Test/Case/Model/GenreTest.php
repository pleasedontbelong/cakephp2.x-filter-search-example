<?php
App::uses('Genre', 'Model');

/**
 * Genre Test Case
 *
 */
class GenreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.genre'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Genre = ClassRegistry::init('Genre');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Genre);

		parent::tearDown();
	}

}
