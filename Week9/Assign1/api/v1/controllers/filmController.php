<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Film.php';


class filmController extends initController {

	public function insert() {

		$film = new Film();
		$this->create($film);
	}
}