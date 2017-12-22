<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Customer.php';


class customerController extends initController {

	private $customer;

	public function __construct() {
		$this->customer = new Customer();
	}

	public function insert() {
		$this->create($this->customer);
	}

	public function removeIfId($id) {
		$this->deleteIfId($this->customer, $id);
	}

	public function remove() {
		$this->delete($this->customer);
	}

	public function partialUpdate($id) {
		$this->patch($this->customer, $id);
	}
}