<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Address.php';


class addressController extends initController {

	public function insert() {

		$address = new Address();
		$this->create($address);
	}
}