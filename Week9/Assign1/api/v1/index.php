<?php
foreach (scandir('controllers') as $filename) {
	if($filename != "initController.php") {
	    $path = 'controllers'.DIRECTORY_SEPARATOR.$filename;
	    if (is_file($path)) {
            require_once $path;
	    }
	}
}

$method = $_SERVER['REQUEST_METHOD'];
$pathInfo = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$tableSelected = array_shift($pathInfo);

switch ($tableSelected) { 
	case 'customer': {
    	$controller = new customerController();
    	break;
    } case 'address': {
    	$controller = new addressController();
    	break;
    } case 'film': {
    	$controller = new filmController();
    	break;
    } case 'actor': {
    	$controller = new actorController();
    	break;
    } case 'store': {
    	$controller = new storeController();
    	break;
    } case 'rental': {
    	$controller = new rentalController();
    	break;
    } case 'payment': {
    	$controller = new paymentController();
    	break;
    } case 'staff': {
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
        if (count($pathInfo) == 1) {
            $id = array_shift($pathInfo);
            $controller->update($id);
        }
    	break;
    }
    case 'PATCH':
    {
        if (count($pathInfo) == 1) {
            $id = array_shift($pathInfo);
            $controller->partialUpdate($id);
        }
    	break;
    }
	case 'DELETE':
    {
        if(count($pathInfo) == 0) {
            $controller->remove();
        } elseif (count($pathInfo) == 1) {
            $id = array_shift($pathInfo);
            $controller->removeIfId($id);
        }
    	break;
    }
}
