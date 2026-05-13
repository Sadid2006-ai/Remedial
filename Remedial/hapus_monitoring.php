<?php
require 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM monitoring WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

unlink("uploads/".$d['foto_bukti']);

mysqli_query($conn, "DELETE FROM monitoring WHERE id='$id'");

header("Location: monitoring.php");
?>