
<?php
include "config/koneksi.php";
// Cek email kustomer di database
$cek_email = mysql_num_rows(mysql_query("SELECT email FROM member WHERE email='$_POST[email]'"));
// Kalau email tidak ditemukan
if ($cek_email == 0) {
     echo "<script>alert('Email Anda tidak terdaftar/Salah, silahkan ulangi lagi'); window.location = 'lupa-password.html'</script>";
} else {

    $password_baru = substr(md5(uniqid(rand(), 1)), 3, 10);

// ganti password member dengan password yang baru (reset password)
    $query = mysql_query("update member set password=md5('$password_baru') where email='$_POST[email]'");

// dapatkan email_pengelola dari database
    $sql2 = mysql_query("select email from admins");
    $j2 = mysql_fetch_array($sql2);

    $subjek = "Password Baru";
    $pesan = "Password Anda yang baru adalah <b>$password_baru</b>";
// Kirim email dalam format HTML
    $dari = "From: $j2[email]\r\n";
    $dari .= "Content-type: text/html\r\n";

// Kirim password ke email member
    mail($_POST[email], $subjek, $pesan, $dari);

    echo "<script>alert('Password Anda yang baru sudah terkirim ke email Anda, Silahkan cek terlebih dahulu'); window.location = 'login-member.html'</script>";
}
?>
