<?php
require 'koneksi.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($data);

    if($user){

        if(password_verify($password, $user['password'])){

            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
        } else {
            echo "Password salah";
        }

    } else {
        echo "Email tidak ditemukan";
    }
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">
    <div class="card">
        <h2>Login</h2>

        <form method="POST">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <button type="submit" name="login">Login</button>
        </form>

        <p>Belum punya akun? <a href="register.php">Register</a></p>
    </div>
</div>