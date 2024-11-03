<?php
include("koneksi.php");

$id = "";
$nama = "";
$nomor_hp = "";

// Aksi Tambah Data
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nomor_hp = $_POST['nomor_hp'];
    $result = mysqli_query($koneksi, "INSERT INTO kurir(id, nama, nomor_hp) VALUES('$id', '$nama', '$nomor_hp')");
    header("Location: kurir.php"); // Redirect ke halaman utama setelah menambah data
}

// Aksi Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nomor_hp = $_POST['nomor_hp'];

    $result = mysqli_query($koneksi, "UPDATE kurir SET nama='$nama', nomor_hp='$nomor_hp' WHERE id='$id'");
    header("Location: kurir.php");
}

// Ambil data untuk form Update
if (isset($_GET['aksi']) && $_GET['aksi'] == 'update' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM kurir WHERE id='$id'");
    if ($user_data = mysqli_fetch_array($result)) {
        $id = $user_data['id'];
        $nama = $user_data['nama'];
        $nomor_hp = $user_data['nomor_hp'];
    }
}

// Aksi Hapus Data
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM kurir WHERE id='$id'");
    header("Location: kurir.php"); // Redirect kembali ke halaman utama setelah delete
}

// Ambil semua data kurir
$result = mysqli_query($koneksi, "SELECT * FROM kurir ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kurir</title>
    <style>
        .content { display: none; }
        .active { display: block; }
        table.second th, table.second td { padding: 7px; }
    </style>
</head>
<body>
    <!-- Create Section -->
    <div id="create" class="content <?php echo (!isset($_GET['aksi']) || $_GET['aksi'] == 'create') ? 'active' : ''; ?>">
        <h1>Tambah kurir</h1>
        <form action="kurir.php" method="post">
            <table class="first">
                <tr>
                    <td>ID</td>
                    <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required></td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td><input type="text" name="nomor_hp" id="nomor_hp" value="<?php echo $nomor_hp; ?>" required></td>
                </tr>
                <tr>
                    <td><button type="submit" id="submit" name="add">Tambah</button></td>
                    <td><button type="reset" name="cancel" onclick="resetForm()">Batal</button></td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Update Section -->
    <div id="update" class="content <?php echo (isset($_GET['aksi']) && $_GET['aksi'] == 'update') ? 'active' : ''; ?>">
        <h1>Ubah kurir</h1>
        <form action="kurir.php" method="post">
            <table class="first">
                <tr>
                    <td>ID</td>
                    <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required></td>
                </tr>
                <tr>
                    <td>Nomor HP</td>
                    <td><input type="text" name="nomor_hp" id="nomor_hp" value="<?php echo $nomor_hp; ?>" required></td>
                </tr>
                <tr>
                    <td><input type="submit" id="submitButton" name="update" value="Ubah"></td>
                    <td><input type="reset" name="cancel" value="Batal" onclick="resetForm()"></td>
                </tr>
            </table>
        </form>
    </div>

    <h1>Data kurir</h1>
    <table class="second" border=1>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['nomor_hp']."</td>";
            echo "<td>
                <a href='kurir.php?aksi=update&id=".$row['id']."'>Ubah</a> | 
                <a href='kurir.php?aksi=delete&id=".$row['id']."'>Hapus</a>
            </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="index.php">Kembali</a>    
</body>
</html>
