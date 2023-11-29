<?php
// TODO 1: Buat sebuah sesi baru
session_start();

// TODO 2 : Lakukan koneksi dengan database
require_once('./lib/db_login.php');

// Memeriksa apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = 'Email is required';
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Invalid email format';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password is required';
        $valid = FALSE;
    }

    // Memeriksa validasi
    if ($valid) {
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = " SELECT * FROM admin WHERE email='".$email."' AND password='".$password."' ";
        // TODO 4: Eksekusi query
        $result = $db->query($query);
        if (!$result) {
            die ("Could not query the database: <br />". $db->error ."<br>Query:".$query);
        } else {
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $email;
                header('Location: view_books.php');
                exit;
            } else {
                echo '<span class="error text-danger" style="display:flex; justify-content:center; ">Combination of email and password are not correct.</span>';
            }
        }

        // TODO 5: Tutup koneksi dengan database
        $db->close();
    }
}
?>
<?php include('./header.php') ?>
<style>
    body {
        background-image: url('img/image.png'); 
        background-size: cover; 
        background-repeat: no-repeat;
        background-attachment: fixed; 
    }

    button {
        width: 100%;
        height: 40px;
        border-radius: 50px;
        border: 1px solid #ced4da;
        padding: 10px;
        background-color: #28a745;
        color: white;
        font-weight: bold;
    }

    .card {
        height: 400px;
        width: 400px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        /*backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.8);*/
    }

    .card-header {
        background-color: transparent;
        text-decoration: none;
        border-bottom: none;
        margin-top: 3rem;
    }

    .card-body {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
        margin-top: 2rem;
        padding-bottom: 3rem;
    }

    .form-control {
        width: 300px;
        height: 50px;
        border-radius: 25px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
</style>
<body>
<br>
<br>
<div class="card mt-5">
    <div class="card-header"><p class="h1 text-center">🔐Login</p></h1?</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control decoration" id="email" name="email" placeholder="name@email.com" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<br>
<br>
<br>
<br>
<br>
<br>
<p class="text-center mt-5 text-white">Created with <span style="color: #ff0000">&#9829;</span> by Kelompok 4</p>
</body>
