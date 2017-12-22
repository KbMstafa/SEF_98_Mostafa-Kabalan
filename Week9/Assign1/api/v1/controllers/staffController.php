<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Staff.php';


class staffController extends initController {

	private $staff;

	public function __construct() {
		$this->staff = new Staff();
	}

	public function partialUpdate($id) {
		$this->patch($this->staff, $id);
	}
}