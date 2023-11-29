<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header"><p class="h1 text-center">Search Books</p></div>
    <div class="card-body">
        
        <div>
            <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <input type="text" name="keyword" autofocus="" placeholder="search books" class="form-control" autocomplete="off" value="<?php echo isset($_POST['search']) ? $_POST['keyword'] : ''; ?>">
                </div>
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div>
            <?php
            function searchBooks($keyword) {
                // Include our login information
                session_start();
                require_once('./lib/db_login.php');
                
                // Periksa apakah pengguna sudah login atau belum
                if (!isset($_SESSION['username'])) {
                    header('Location: login.php');
                    exit;
                }

                // Escape the keyword to prevent SQL injection
                $keyword = $db->real_escape_string($keyword);

                // TODO: Buat kueri SQL pencarian dengan menggunakan kata kunci
                $query = "SELECT books.*, categories.name AS category_name
                        FROM books
                        LEFT JOIN categories ON books.categoryid = categories.categoryid
                        WHERE books.isbn LIKE '%$keyword%'
                        OR books.title LIKE '%$keyword%'
                        OR books.author LIKE '%$keyword%'
                        OR categories.name LIKE '%$keyword%'
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
                $db->close();

                return $searchResults;
            }
            ?>

            <?php
            $keyword = isset($_POST['search']) ? $_POST['keyword'] : '';
            $searchResults = [];

            if (!empty($keyword)) {
                $searchResults = searchBooks($keyword);
            }

            if (!empty($searchResults)) {
                echo '<p class="h3 text-center">Book List:</p>';
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
                    echo '<td>' . $result->isbn . '</td>';
                    echo '<td>' . $result->title . '</td>';
                    echo '<td>' . $result->category_name . '</td>';
                    echo '<td>' . $result->author . '</td>';
                    echo '<td>$' . $result->price . '</td>';
                    echo '<td style="text-align: start;"><a class="btn btn-info btn-sm " href="book_detail.php?id=' . $result->isbn . '">Detail</a>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '<br />';
                echo 'Total Rows = ' . count($searchResults);
            } else {
                echo '<p class="h3 text-center">Book List:</p>';
            }
            ?>
        </div>
    </div>
</div>
<?php include('./footer.php') ?>
