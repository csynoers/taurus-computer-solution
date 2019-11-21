<?php
    require_once 'vendor/autoload.php';
    switch ($_GET['q']) {
        case 'get-kota-by-city-id':
            echo json_encode( RajaOngkir\RajaOngkir::Kota()->find($_GET['id']) );
            break;
        
        default:
            # code...
            break;
    }