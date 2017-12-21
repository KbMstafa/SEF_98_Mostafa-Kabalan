<?php
foreach (scandir('controllers') as $filename) {
	/*if($filename != "initController.php") {*/
	    $path = 'controllers'.DIRECTORY_SEPARATOR.$filename;
	    if (is_file($path)) {
	        echo $path;
            echo "\n";
            require_once $path;
	    }
	/*}*/
}

$method = $_SERVER['REQUEST_METHOD'];
$pathInfo = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$tableSelected = array_shift($pathInfo);
var_dump($pathInfo);
echo count($pathInfo);

switch ($tableSelected) { 
	case 'customer': {
    	echo "customer";
    	$controller = new customerController();
    	break;
    } case 'address': {
    	echo "address";
    	$controller = new addressController();
    	break;
    } case 'film': {
    	echo "film";
    	$controller = new filmController();
    	break;
    } case 'actor': {
    	echo "actor";
    	$controller = new actorController();
    	break;
    } case 'store': {
    	echo "store";
    	$controller = new storeController();
    	break;
    } case 'rental': {
    	echo "rental";
    	$controller = new rentalController();
    	break;
    } case 'payment': {
    	echo "payment";
    	$controller = new paymentController();
    	break;
    } case 'staff': {
    	echo "staff";
    	$controller = new staffController();
    	break;
    } 
};

switch ($method) {
	case 'GET':
    {
    	echo "GET";
    	break;
    }
	case 'POST':
    {
    	$controller->insert();
    	break;
    }
	case 'PUT':
    {
    	echo "PUT";
    	break;
    }
    case 'PATCH':
    {
    	echo "PATCH";
    	break;
    }
	case 'DELETE':
    {
    	echo "DELETE";
    	break;
    }
}
