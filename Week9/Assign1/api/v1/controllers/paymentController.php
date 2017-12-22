<?php
require_once 'config'.DIRECTORY_SEPARATOR.'Database.php';
require_once 'objects'.DIRECTORY_SEPARATOR.'Payment.php';


class paymentController extends initController {

	private $payment;

	public function __construct() {
		$this->payment = new Payment();
	}

	public function partialUpdate($id) {
		$this->patch($this->payment, $id);
	}
}