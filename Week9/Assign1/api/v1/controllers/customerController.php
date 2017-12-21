<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'initController.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Customer.php';


class customerController extends initController {

	public function insert() {

		$customer = new Customer();
		$this->create($customer);
	}
}