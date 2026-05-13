<?php
require 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

if(isset($_POST['simpan'])){

    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];
    $tinggi = $_POST['tinggi'];
    $deskripsi = $_POST['deskripsi'];

    if($tinggi <= 50){
        $status = "Aman";
    } elseif($tinggi <= 100){
        $status = "Waspada";
    } else {
        $status = "Bahaya";
    }

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$foto);

    mysqli_query($conn, "INSERT INTO monitoring VALUES(
        '',
        '$_SESSION[id]',
        '$lokasi',
        '$waktu',
        '$tinggi',
        '$status',
        '$deskripsi',
        '$foto'
    )");

    header("Location: monitoring.php");
}
?>

<link rel="stylesheet" href="assets/style.css">

<?php include 'navbar.php'; ?>

<div class="container">

    <div class="card">

        <h2>Tambah Monitoring</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="lokasi" placeholder="Lokasi Sungai">

            <input type="datetime-local" name="waktu">

            <input type="number" name="tinggi" placeholder="Tinggi Air">

            <textarea name="deskripsi" placeholder="Deskripsi"></textarea>

            <input type="file" name="foto">

            <button type="submit" name="simpan">Simpan</button>

        </form>

    </div>

</div>

<?php include 'footer.php'; ?>