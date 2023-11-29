<?php include('./header.php'); ?>

<div class="card mt-5">
    <div class="card-header">
        <p class="h1 text-center">🔍 Search Book</p>
    </div>
    <div class="card-body">
        <div>
            <form action="" method="get" class="form-inline">
                <div class="form-group">
                    <label for="keyword">Search:</label>
                    <input type="text" name="keyword" autofocus placeholder="Search books" class="form-control" autocomplete="off" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="price_range">Price Range:</label>
                    <select name="price_range" id="price_range" class="form-control">
                        <option value="">Select Range</option>
                        <option value="0-20" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '0-20') ? 'selected' : ''; ?>>$0 - $20</option>
                        <option value="21-40" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '21-40') ? 'selected' : ''; ?>>$21 - $40</option>
                        <option value="41-60" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '41-60') ? 'selected' : ''; ?>>$41 - $60</option>
                        <option value="61-80" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '61-80') ? 'selected' : ''; ?>>$61 - $80</option>
                        <option value="81-100" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '81-100') ? 'selected' : ''; ?>>$81 - $100</option>
                        <option value="101-0" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] === '101-0') ? 'selected' : ''; ?>>>$100</option>
                    </select>
                </div>
                <button type="submit" name="search" class="btn btn-secondary mt-3 mb-4">Search</button>
            </form>
        </div>

        <div>
            <?php
            // Include our login information
            session_start();
            require_once('./lib/db_login.php');

            // Periksa apakah pengguna sudah login atau belum
            if (!isset($_SESSION['username'])) {
                header('Location: login.php');
                exit;
            }

            function searchBooks($keyword, $price_range, $db)
            {
                // Escape the keyword to prevent SQL injection
                $keyword = $db->real_escape_string($keyword);

                // Initialize the price range condition
                $price_condition = '';

                // Check if a price range is selected
                if (!empty($price_range)) {
                    list($min_price, $max_price) = explode('-', $price_range);

                    // Include the price range condition in the SQL query
                    $price_condition = "AND books.price >= $min_price AND books.price <= $max_price";
                }

                // TODO: Buat kueri SQL pencarian dengan menggunakan kata kunci
                $query = "SELECT books.*, categories.name AS category_name
                          FROM books
                          LEFT JOIN categories ON books.categoryid = categories.categoryid
                          WHERE (books.isbn LIKE '%$keyword%'
                          OR books.title LIKE '%$keyword%'
                          OR books.author LIKE '%$keyword%'
                          OR categories.name LIKE '%$keyword%')
                          $price_condition
                          ORDER BY books.isbn";

                $result = $db->query($query);
                if (!$result) {
                    die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
                }

                // Fetch and return the search results
                $searchResults = [];
                while ($row = $result->fetch_object()) {
                    $searchResults[] = $row;
                }

                $result->free();

                return $searchResults;
            }

            $keyword = isset($_GET['search']) ? $_GET['keyword'] : '';
            $price_range = isset($_GET['search']) ? $_GET['price_range'] : '';
            $searchResults = [];

            if (!empty($keyword) || !empty($price_range)) {
                $searchResults = searchBooks($keyword, $price_range, $db);
            } else {
                $searchResults = []; // Mengosongkan hasil pencarian jika tidak ada kata kunci pencarian atau rentang harga
            }

            if (!empty($searchResults)) {
                echo '<table class="table table-striped">';
                echo '<tr>';
                echo '<th>ISBN</th>';
                echo '<th>Title</th>';
                echo '<th>Category</th>';
                echo '<th>Author</th>';
                echo '<th>Price</th>';
                echo '<th>Detail</th>';
                echo '</tr>';

                foreach ($searchResults as $result) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($result->isbn) . '</td>';
                    echo '<td>' . htmlspecialchars($result->title) . '</td>';
                    echo '<td>' . htmlspecialchars($result->category_name) . '</td>';
                    echo '<td>' . htmlspecialchars($result->author) . '</td>';
                    echo '<td>$' . htmlspecialchars($result->price) . '</td>';
                    echo '<td style="text-align: center;"><a class="btn btn-secondary btn-sm" href="book_detail.php?id=' . htmlspecialchars($result->isbn) . '">Detail</a>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '<br />';
                echo 'Total Rows = ' . count($searchResults);
            } else {
                echo '<p class="h3 text-center">Book List</p>';
            }

            $db->close();
            ?>
        </div>
        <!-- Tombol "View All Books" yang baru ditambahkan -->
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="view_books.php">View Books Data </a>
        </div>
    </div>
</div>
<br>
<br>
<p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
<br>
<?php include('./footer.php'); ?>
