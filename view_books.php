<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header"><p class="h1 text-center">📚 Books Data</p></div>
    <div class="card-body">
        <div style="display: flex; justify-content: flex-end;">
            <a href="searching.php" class="btn btn-primary mb-3" style="margin-right: 5px;">Search Book</a>
            <a href="order_item.php" class="btn btn-success mb-3" style="margin-right: 5px;">View Order</a>
            <a href="view_chart.php" class="btn btn-success mb-3" style="margin-right: 5px;">View Chart</a>
            <a href="view_kategori.php" class="btn btn-success mb-3" style="margin-right: 5px;">View Category</a>
            <a href="add_books.php" class="btn btn-secondary mb-3">+ Add Book</a>
            <a href="logout.php" class="btn btn-danger mb-3" style="margin-left: 5px;">Logout</a>
        </div>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Price</th>
                <th>Action (Edit/ Delete)</th>
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
                        ORDER BY books.isbn";
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
            }
            // Fetch and display the results
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td>' . $row->title . '</td>';
                echo '<td>' . $row->category_name . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>$' . $row->price . '</td>';
                echo '<td style="text-align: center;"><a class="btn btn-warning btn-sm " href="edit_book.php?id=' . $row->isbn . '">Edit</a>';
                echo '<a class="btn btn-danger btn-sm" style="margin-left: 10px;" href="delete_book.php?id=' . $row->isbn . '">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br />';
            echo '<p style="display: flex; justify-content: flex-end;">Total Books : ' . $result->num_rows. '</p>';

            $result->free();
            $db->close();
            ?>
    </div>
</div>
<br>
<br>
<p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
<br>
<?php include('./footer.php') ?>