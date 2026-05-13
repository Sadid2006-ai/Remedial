<?php
require 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM monitoring"));
$aman = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM monitoring WHERE status_banjir='Aman'"));
$waspada = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM monitoring WHERE status_banjir='Waspada'"));
$bahaya = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM monitoring WHERE status_banjir='Bahaya'"));

$dataBaru = mysqli_query($conn, "SELECT * FROM monitoring ORDER BY id DESC LIMIT 5");
?>

<link rel="stylesheet" href="assets/style.css">

<?php include 'navbar.php'; ?>

<div class="container">

    <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?></h2>

    <div class="card">
        <h3>Total Monitoring: <?php echo $total; ?></h3>
        <h3>Aman: <?php echo $aman; ?></h3>
        <h3>Waspada: <?php echo $waspada; ?></h3>
        <h3>Bahaya: <?php echo $bahaya; ?></h3>
    </div>

    <div class="card">
        <h3>Monitoring Terbaru</h3>

        <table>
            <tr>
                <th>Lokasi</th>
                <th>Tinggi Air</th>
                <th>Status</th>
            </tr>

            <?php while($d = mysqli_fetch_assoc($dataBaru)){ ?>

            <tr>
                <td><?php echo $d['lokasi_sungai']; ?></td>
                <td><?php echo $d['tinggi_air']; ?> cm</td>
                <td><?php echo $d['status_banjir']; ?></td>
            </tr>

            <?php } ?>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>