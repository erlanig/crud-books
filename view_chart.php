<?php
// TODO 1: Lakukan koneksi dengan database
session_start();
require_once('./lib/db_login.php');

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Query untuk mengambil jumlah data buku pada tiap kategori
$query = "SELECT categories.name AS category_name, COUNT(*) AS book_count
          FROM books
          LEFT JOIN categories ON books.categoryid = categories.categoryid
          GROUP BY categories.name";

$result = $db->query($query);

// Data untuk grafik
$data = [];
$data[] = ['Category', 'Book Count'];

while ($row = $result->fetch_assoc()){
    $data[] = [$row['category_name'], (int)$row['book_count']];
}

// Tutup koneksi database
$db->close();
?>

<?php include('./header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category-wise Book Count</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background-color: #ffffff;
        }
        .container {
            padding: 20px;
        }
        .card {
            width: 100%;
            margin-top: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: #ffffff;
        }
        .card-body {
            padding: 20px;
            border-radius: 20px;
        }
    </style>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart(){
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

            var options = {
                pieHole: 0.5
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center mt-3">📊 Category-wise Book Count</h2>
            </div>
            <div class="card-body">
                <div id="chart_div" class="mx-auto" style="width: 1000px; height: 500px;"></div>
                <div class="d-flex justify-content-end">
                    <a href="view_books.php" class="btn btn-primary">View Books Data</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
    <br>
</body>
</html>
