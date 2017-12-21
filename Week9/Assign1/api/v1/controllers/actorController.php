<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Actor.php';


class actorController extends initController {

	public function insert() {

		$actor = new Actor();
		$this->create($actor);
	}
}