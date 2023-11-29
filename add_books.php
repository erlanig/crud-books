<?php
// TODO 1: Buat koneksi dengan database
session_start();
require_once('./lib/db_login.php');
            
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$valid = TRUE;

if (isset($_POST["submit"])){
    $isbn = test_input($_POST['isbn']);
    $author = test_input($_POST['author']);
    $title = test_input($_POST['title']);
    $price = test_input($_POST['price']);
    $categoryid = $_POST['categoryid'];

    if ($isbn == ''){
        $error_isbn = "ISBN is required";
        $valid = FALSE;
    }

    if ($author == ''){
        $error_author = "Author is required";
        $valid = FALSE;
    }

    if ($title == ''){
        $error_title = "Title is required";
        $valid = FALSE;
    }

    if ($price == ''){
        $error_price = "Price is required";
        $valid = FALSE;
    }

    if ($categoryid == '' || $categoryid == 'none'){
        $error_categoryid = "Category is required";
        $valid = FALSE;
    }

    // insert data into database
    if ($valid){
        // escape inputs data
        $isbn = $db->real_escape_string($isbn);
        $author = $db->real_escape_string($author);
        $title = $db->real_escape_string($title);
        $price = $db->real_escape_string($price);
        $categoryid = $db->real_escape_string($categoryid);
        // asign a query
        $query = "INSERT INTO books (isbn, author, title, price, categoryid) VALUES('".$isbn."','".$author."','".$title."','".$price."','".$categoryid."')";
        // execute the query
        $result = $db->query($query);
        if (!$result){
            die ("Could not query the database: <br />". $db->error. 'query = '.$query);
        } else{
            header('Location: view_books.php');
        }
        //close db connection
        $db->close();		
    }
}
?>

<?php include('./header.php') ?>
<!DOCTYPE HTML> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
  </head>
  <body>
  	<div class="container">
	<br>
	<div class="card">
	<div class="card-header"><p class="h1 text-center">📖 Add Book</p></div>
	<div class="card-body">
	<br>
	<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form-group">
		<label for="isbn">ISBN:</label>
		<input type="text" class="form-control" id="isbn" name="isbn" value="">
		<div class="error" style="color: red;"><?php if(isset($error_isbn)) echo $error_isbn;?></div>
	</div>
	<div class="form-group">
		<label for="author">Author:</label>
		<input type="text" class="form-control" id="author" name="author" value="">
		<div class="error" style="color: red;"><?php if(isset($error_author)) echo $error_author;?></div>
	</div>
	<div class="form-group">
		<label for="title">Title:</label>
		<input type="text" class="form-control" id="title" name="title" value="">
		<div class="error" style="color: red;"><?php if(isset($error_title)) echo $error_title;?></div>
	</div>
	<div class="form-group">
		<label for="price">Price:</label>
		<input type="text" class="form-control" id="price" name="price" value="">
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
	</div>
    <br>
    <br>
    <p class="text-center mb-3">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
    <br>
  </body>
</html>
