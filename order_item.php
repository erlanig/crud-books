<?php include('./header.php') ?>

<div class="card mt-5">
<div class="card-header"><p class="h1 text-center">🛒 Order List</p></div>
    <div class="card-body">
        <form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="d-flex align-items-end">
                <div class="form-inline col-md-1 mb-1">
                    <label for="start_date">Start Date:</label>
                </div>
                <div class="form-inline col-md-3">
                    <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                </div>
                <div class="form-inline col-md-1 mb-1" style="margin-left: 30px;">
                    <label for="end_date">End Date:</label>
                </div>
                <div class="form-inline col-md-3">
                    <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                </div>
                <div class="form-group col-md-3 mt-3" style="margin-left: 30px;">
                    <button type="submit" class="btn btn-primary btn-sm" id="filter_button">Filter</button>
                </div>
            </div>
        </form>
        
        <table class="mt-3 table table-striped">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Book Title</th>
                <th>Qty</th>
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

            // Inisialisasi filter tanggal mulai dan tanggal selesai
            $start_date = "";
            $end_date = "";

            // Periksa apakah filter telah disubmit
            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date'];
                
                // Buat query dengan filter tanggal
                $query = "SELECT order_items.*, books.title AS order_name
                          FROM order_items
                          LEFT JOIN books ON order_items.isbn = books.isbn
                          WHERE order_items.order_date BETWEEN '$start_date' AND '$end_date'
                          ORDER BY order_items.orderid";
            } else {
                // Query tanpa filter tanggal
                $query = "SELECT order_items.*, books.title AS order_name
                          FROM order_items
                          LEFT JOIN books ON order_items.isbn = books.isbn
                          ORDER BY order_items.orderid";
            }

            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
            }
            // Fetch and display the results
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->orderid . '</td>';
                echo '<td>' . $row->order_date . '</td>';
                echo '<td>' . $row->order_name . '</td>';
                echo '<td>' . $row->quantity . '</td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br />';
            echo 'Total Order Items = ' . $result->num_rows;

            $result->free();
            $db->close();
            ?>
        </table>
        <div class="d-flex justify-content-end">
            <a href="view_books.php" class="btn btn-primary">View Books Data</a>
        </div>
    </div>
</div>
<br>
<br>
<p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
<br>
<?php include('./footer.php') ?>
