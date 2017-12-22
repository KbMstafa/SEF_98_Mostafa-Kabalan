<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Store.php';


class storeController extends initController {

	private $store;

	public function __construct() {
		$this->store = new Store();
	}

	public function partialUpdate($id) {
		$this->patch($this->store, $id);
	}
}