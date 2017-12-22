<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Actor.php';


class actorController extends initController {

	private $actor;

	public function __construct() {
		$this->actor = new Actor();
	}

	public function insert() {
		$this->create($this->actor);
	}

	public function partialUpdate($id) {
		$this->patch($this->actor, $id);
	}

	public function update($id) {
		$this->put($this->actor, $id);
	}
}