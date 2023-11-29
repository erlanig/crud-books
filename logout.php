<?php
// TODO 1: Inisialisasi session (cukup lakukan ini sekali di awal)
session_start();

// TODO 2: Periksa apakah sesi 'username' sudah ada
if (isset($_SESSION['username'])) {
    // TODO 3: Hapus username session
    unset($_SESSION['username']);
    // TODO 4: Hancurkan sesi
    session_destroy();
}

// TODO 5: Redirect ke halaman login
header('Location: login.php');
exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
?>
