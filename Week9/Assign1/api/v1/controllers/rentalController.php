<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Rental.php';


class rentalController extends initController {

	private $rental;

	public function __construct() {
		$this->rental = new Rental();
	}

	public function partialUpdate($id) {
	$this->patch($this->rental, $id);
	}
}