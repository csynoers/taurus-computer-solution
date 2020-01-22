<?php
    include_once "config/koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = file_get_contents("php://input");
        $result = json_decode($data);
        if ( $result->status == 'PAID' ) {
            mysql_query("UPDATE `orders` SET `status`='{$result->status}',`status_order`='dikemas' WHERE `external_id`='{$result->id}' ");
        }

        if ( $result->status == 'EXPIRED' ) {
            mysql_query("UPDATE `orders` SET `status`='{$result->status}',`status_order`='dibatalkan' WHERE `external_id`='{$result->id}' ");
        }
        print_r("\n\$data contains the updated invoice data \n\n");
        print_r($data);
        print_r("\n\nUpdate your database with the invoice status \n\n");
    } else {
        print_r("Cannot ".$_SERVER["REQUEST_METHOD"]." ".$_SERVER["SCRIPT_NAME"]);
    }