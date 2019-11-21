<?php
    require_once __DIR__."classes/class.phpmailer.php";
    $mail = new PHPMailer; 
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 0;
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = "3s0c9m7@gmail.com";
    $mail->Password = $mail->simple_crypt( 'Q28vcmJtWmxESE1UQjBCazFQL2w3QT09', 'd' );
    $mail->SetFrom("info@tauruscomputer.com","TAURUS COMPUTER");
    $mail->Subject = "Verifikasi Email";
    $mail->AddAddress("scmrumahweb@gmail.com","nama email tujuan");
    $mail->MsgHTML("Testing...");
    
    // $mail->Send()
    // Silakan verifikasi email kamu dengan mengklik / copy
    // tautan berikut kedalam browser :
?>