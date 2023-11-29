<?php
session_start();
require_once('./lib/db_login.php');
            
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$id = $_GET['id'];

$query = "DELETE FROM books WHERE isbn ='$id'";
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error . '<br>Query: ' . $query);
} else {
    $db->close();
    header('Location: view_books.php');
}
?>