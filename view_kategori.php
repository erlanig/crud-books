<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">
        <p class="h1 text-center">📖 Books Category</p>
    </div>
    <div class="card-body">
        <div style="display: flex; justify-content: flex-end;">
        </div>
        <table class="table table-striped">
            <tr>
                <th>Category</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
            </tr>

            <?php
            // Include our login information
            session_start();
            require_once('./lib/db_login.php');
            
            // Periksa apakah pengguna sudah login atau belum
            if (!isset($_SESSION['username'])) {
                header('Location: login.php');
                exit;
            }

            // TODO 1: Tuliskan dan eksekusi query
            $query = "SELECT books.*, categories.name AS category_name
                        FROM books
                        LEFT JOIN categories ON books.categoryid = categories.categoryid
                        ORDER BY category_name, title"; // Mengurutkan berdasarkan nama kategori
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
            }

            $currentCategory = null; // Kategori saat ini

            // Fetch and display the results
            while ($row = $result->fetch_object()) {
                if ($row->category_name != $currentCategory) {
                    // Jika kategori berbeda dari baris sebelumnya, tampilkan kategori baru dengan rowspan
                    $currentCategory = $row->category_name;
                    $rowspan = 1;

                    echo '<tr>';
                    echo '<td rowspan="' . $rowspan . '"><strong>' . $currentCategory . '</strong></td>';
                    echo '<td>' . $row->isbn . '</td>';
                    echo '<td>' . $row->title . '</td>';
                    echo '<td>' . $row->author . '</td>';
                    echo '<td>$' . $row->price . '</td>';
                    echo '</tr>';
                } else {
                    // Jika kategori sama, tambahkan rowspan ke sel sebelumnya dan kosongkan kolom kategori
                    $rowspan++;

                    // Hanya kosongkan kolom kategori untuk sel pertama
                    if ($rowspan > 1) {
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>$' . $row->price . '</td>';
                        echo '</tr>';
                    }
                }
            }

            echo '</table>';
            echo '<br />';

            $result->free();
            $db->close();
            ?>
        </table>
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="view_books.php">View All Books</a>
        </div>
    </div>
</div>

<br>
<br>
<p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
<br>
<?php include('./footer.php') ?>