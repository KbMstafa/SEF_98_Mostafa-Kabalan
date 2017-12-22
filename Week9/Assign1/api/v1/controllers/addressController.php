<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Address.php';


class addressController extends initController {

	private $address;

	public function __construct() {
		$this->address = new Address();
	}

	public function insert() {
		$this->create($this->address);
	}

	public function removeIfId($id) {
		$this->deleteIfId($this->address, $id);
	}

	public function remove() {
		$this->delete($this->address);
	}

	public function partialUpdate($id) {
		$this->patch($this->address, $id);
	}
}