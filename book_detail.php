<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku dan Review</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">💖 Book Review</h1>
            </div>
            <div class="card-body">
                <?php
                // Kode PHP untuk mengambil detail buku dari basis data berdasarkan ID yang dikirimkan melalui URL
                session_start();
                require_once('./lib/db_login.php');
                            
                // Periksa apakah pengguna sudah login atau belum
                if (!isset($_SESSION['username'])) {
                    header('Location: login.php');
                    exit;
                }
                
                // Ambil ISBN buku dari parameter URL
                $isbn = $_GET['id'];
                
                $query = "SELECT * FROM books WHERE isbn = '$isbn'";
                $result = $db->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $isbn = $row['isbn'];
                    $title = $row['title'];
                    $author = $row['author'];
                    $price = $row['price'];
                } else {
                    echo "Buku tidak ditemukan.";
                    exit;
                }
                ?>
                <!-- Header Buku -->
                <div class="card-header">
                    <div>
                        <div class="book-title"><h2><?php echo $title; ?></h2></div>
                        <div class="book-author"><?php echo $author; ?></div>
                    </div>
                    <div class="book-price"><h3>$<?php echo $price; ?></h3></div>
                </div>
                
                <!-- Kode PHP untuk menampilkan review buku -->
                <div class="review-section">
                    <h2 class="mt-4">Review:</h2>
                    <?php
                    $query_reviews = "SELECT * FROM book_reviews WHERE isbn = '$isbn'";
                    $reviews_result = $db->query($query_reviews);
                    
                    if ($reviews_result->num_rows > 0) {
                        while ($review = $reviews_result->fetch_assoc()) {
                            $review_text = $review['review'];
                            ?>
                            <div class="review-card">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo $review_text; ?>
                                        <span class=""><i class="fa fa-star"></i></span>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>Belum ada review untuk buku ini.</p>";
                    }
                    ?>
                </div>

                <!-- Form Review -->
                <div class="">
                    <form action="add_review.php" method="post" class="mt-3">
                        <input type="hidden" name="isbn" value="<?php echo $isbn; ?>">
                        <div class="form-floating">
                            <label for="review"><strong>Add Review</strong></label>
                            <textarea class="form-control" placeholder="Leave a comment here" name="review_text" id="floatingTextarea2" style="height: 100px"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success add-review-button mt-3">Submit</button>
                    </form>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <a class="btn btn-primary" href="view_books.php">View Books Data</a>
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
