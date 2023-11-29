<?php
session_start();
require_once('./lib/db_login.php');
            
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;
    $isbn = test_input($_POST['isbn']);
    $author = test_input($_POST['author']);
    $title = test_input($_POST['title']);
    $price = test_input($_POST['price']);
    $categoryid = $_POST['categoryid'];

    // Validasi terhadap field ISBN
    if ($isbn == '') {
        $error_isbn = "ISBN is required";
        $valid = FALSE;
    } 

    // Validasi terhadap field Author
    if ($author == '') {
        $error_author = "Author is required";
        $valid = FALSE;
    }

    // Validasi terhadap field Title
    if ($title == '') {
        $error_title = "Title is required";
        $valid = FALSE;
    }

    // Validasi terhadap field Price
    if ($price == '') {
        $error_price = "Price is required";
        $valid = FALSE;
    }

    // Validasi terhadap field Category
    if ($categoryid == 'none') {
        $error_categoryid = "Category is required";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        $author = $db->real_escape_string($author);
        $query = "UPDATE books SET isbn='".$isbn."', author='".$author."',
            title='".$title."', price='".$price."', categoryid='".$categoryid."' WHERE isbn='".$id."'";
        // Eksekusi query UPDATE
        $update_result = $db->query($query);
    
        if (!$update_result) {
            die ("Could not update the database: <br />".$db->error. '<br>Query:' .$query);
        } else {
            $db->close();
            header('Location: view_books.php');
        }
    }
}

// Query untuk mengambil informasi buku berdasarkan id
$query = "SELECT books.*, categories.name AS category_name
            FROM books
            LEFT JOIN categories ON books.categoryid = categories.categoryid
            WHERE books.isbn='$id'";

// Mengeksekusi query
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br />" . $db->error);
} else {
    // Mengambil data buku dari hasil query
    $row = $result->fetch_assoc();
    $isbn = $row['isbn'];
    $title = $row['title'];
    $categoryid = $row['categoryid'];
    $author = $row['author'];
    $price = $row['price'];
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header"><p class="h1 text-center">📖 Edit Book Data</p></div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $isbn; ?>">
                <div class="error" style="color: red;"><?php if(isset($error_isbn)) echo $error_isbn;?></div>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= $author; ?>">
                <div class="error" style="color: red;"><?php if(isset($error_author)) echo $error_author;?></div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $title; ?>">
                <div class="error" style="color: red;"><?php if(isset($error_title)) echo $error_title;?></div>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?= $price; ?>">
                <div class="error" style="color: red;"><?php if(isset($error_price)) echo $error_price;?></div>
            </div>
            <div class="form-group">
                <label for="categoryid">Category:</label>
                <select name="categoryid" id="categoryid" class="form-control" required>
                    <option value="none" <?php if (!isset($categoryid)) echo 'selected="true"';?> disabled>--Select a category--</option>
                    <option value="1" <?php if (isset($categoryid) && $categoryid == '1') echo 'selected="true"'; ?>>Encyclopedia</option>
                    <option value="2" <?php if (isset($categoryid) && $categoryid == '2') echo 'selected="true"'; ?>>Novel</option>
                    <option value="3" <?php if (isset($categoryid) && $categoryid == '3') echo 'selected="true"'; ?>>Comic</option>              
                    <option value="4" <?php if (isset($categoryid) && $categoryid == '4') echo 'selected="true"'; ?>>Scientific Books</option>
                </select>
                <div class="error" style="color: red;"><?php if(isset($error_categoryid)) echo $error_categoryid;?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>&nbsp;
            <a href="view_books.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<br>
<br>
<br>
<br>
<p class="text-center mt-5">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
<?php include('./footer.php') ?>
<?php
$db->close();
?>
