<?php
require 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($nama) || empty($email) || empty($password)){
        echo "Semua field wajib diisi";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Email tidak valid";
    } elseif(strlen($password) < 6){
        echo "Password minimal 6 karakter";
    } else {

        $password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn, "INSERT INTO users VALUES('', '$nama', '$email', '$password')");

        header("Location: login.php");
    }
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">
    <div class="card">
        <h2>Register</h2>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <button type="submit" name="register">Register</button>
        </form>

        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</div>