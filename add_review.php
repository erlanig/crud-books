<?php
// Sambungkan ke database
session_start();
require_once('./lib/db_login.php');
                
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
// Kode PHP untuk meng-handle proses review dan penyimpanannya ke database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan bahwa form telah di-submit melalui metode POST

    // Ambil data dari formulir
    $isbn = $db->real_escape_string($_POST['isbn']);
    $review_text = $db->real_escape_string($_POST['review_text']);

    // Buat query untuk menyimpan review ke database
    $query = "INSERT INTO book_reviews (isbn, review) VALUES ('$isbn', '$review_text')";

    // Eksekusi query
    if ($db->query($query)) {
        // Review berhasil disimpan, redirect kembali ke halaman detail buku
        $db->close(); // Tutup koneksi ke database
        header("Location: book_detail.php?id=$isbn"); // Redirect ke halaman detail buku
        exit();
    } else {
        // Jika ada kesalahan dalam eksekusi query
        echo "Error: " . $query . "<br>" . $db->error;
    }
} else {
    // Jika halaman diakses langsung tanpa melalui form POST, redirect ke halaman lain
    header("Location: index.php");
    exit();
}
?>
