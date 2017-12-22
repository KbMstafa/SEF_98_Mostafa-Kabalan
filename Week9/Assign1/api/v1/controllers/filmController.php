<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Film.php';


class filmController extends initController {

	private $film;

	public function __construct() {
		$this->film = new Film();
	}

	public function insert() {
		$this->create($this->film);
	}

	public function removeIfId($id) {
		$this->deleteIfId($this->film, $id);
	}

	public function remove() {
		$this->delete($this->film);
	}

	public function partialUpdate($id) {
		$this->patch($this->film, $id);
	}
}