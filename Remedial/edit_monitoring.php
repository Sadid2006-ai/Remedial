<?php
require 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM monitoring WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

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

    if($foto != ""){

        unlink("uploads/".$d['foto_bukti']);

        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$foto);

    } else {

        $foto = $d['foto_bukti'];
    }

    mysqli_query($conn, "UPDATE monitoring SET
        lokasi_sungai='$lokasi',
        waktu_pengukuran='$waktu',
        tinggi_air='$tinggi',
        status_banjir='$status',
        deskripsi='$deskripsi',
        foto_bukti='$foto'
        WHERE id='$id'
    ");

    header("Location: monitoring.php");
}
?>

<link rel="stylesheet" href="assets/style.css">

<?php include 'navbar.php'; ?>

<div class="container">

    <div class="card">

        <h2>Edit Monitoring</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="lokasi" value="<?php echo $d['lokasi_sungai']; ?>">

            <input type="datetime-local" name="waktu">

            <input type="number" name="tinggi" value="<?php echo $d['tinggi_air']; ?>">

            <textarea name="deskripsi"><?php echo $d['deskripsi']; ?></textarea>

            <input type="file" name="foto">

            <button type="submit" name="update">Update</button>

        </form>

    </div>

</div>

<?php include 'footer.php'; ?>