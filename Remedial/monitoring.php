<?php
require 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

$id_user = $_SESSION['id'];

$data = mysqli_query($conn, "SELECT * FROM monitoring WHERE user_id='$id_user'");
?>

<link rel="stylesheet" href="assets/style.css">

<?php include 'navbar.php'; ?>

<div class="container">

    <div class="card">

        <h2>Data Monitoring</h2>

        <table>
            <tr>
                <th>Lokasi</th>
                <th>Waktu</th>
                <th>Tinggi</th>
                <th>Status</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>

            <?php while($d = mysqli_fetch_assoc($data)){ ?>

            <tr>
                <td><?php echo $d['lokasi_sungai']; ?></td>
                <td><?php echo $d['waktu_pengukuran']; ?></td>
                <td><?php echo $d['tinggi_air']; ?> cm</td>
                <td><?php echo $d['status_banjir']; ?></td>
                <td><?php echo $d['deskripsi']; ?></td>
                <td>
                    <img src="uploads/<?php echo $d['foto_bukti']; ?>" width="100">
                </td>
                <td>
                    <a href="edit_monitoring.php?id=<?php echo $d['id']; ?>">Edit</a>
                    |
                    <a href="hapus_monitoring.php?id=<?php echo $d['id']; ?>">Hapus</a>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php include 'footer.php'; ?>