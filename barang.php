<?php
include("koneksi.php");

$id = "";
$nama = "";
$harga = "";

// Aksi Tambah Data
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $result = mysqli_query($koneksi, "INSERT INTO barang(id, nama, harga) VALUES('$id', '$nama', '$harga')");
    header("Location: barang.php"); // Redirect ke halaman utama setelah menambah data
}

// Aksi Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $result = mysqli_query($koneksi, "UPDATE barang SET nama='$nama', harga='$harga' WHERE id='$id'");
    header("Location: barang.php");
}

// Ambil data untuk form Update
if (isset($_GET['aksi']) && $_GET['aksi'] == 'update' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
    if ($user_data = mysqli_fetch_array($result)) {
        $id = $user_data['id'];
        $nama = $user_data['nama'];
        $harga = $user_data['harga'];
    }
}

// Aksi Hapus Data
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
    header("Location: barang.php"); // Redirect kembali ke halaman utama setelah delete
}

// Ambil semua data barang
$result = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
    <style>
        .content { display: none; }
        .active { display: block; }
        table.second th, table.second td { padding: 7px; }
    </style>
</head>
<body>
    <!-- Create Section -->
    <div id="create" class="content <?php echo (!isset($_GET['aksi']) || $_GET['aksi'] == 'create') ? 'active' : ''; ?>">
        <h1>Tambah Barang</h1>
        <form action="barang.php" method="post">
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
                    <td>Harga</td>
                    <td><input type="text" name="harga" id="harga" value="<?php echo $harga; ?>" required></td>
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
        <h1>Update Barang</h1>
        <form action="barang.php" method="post">
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
                    <td>Harga</td>
                    <td><input type="text" name="harga" id="harga" value="<?php echo $harga; ?>" required></td>
                </tr>
                <tr>
                    <td><input type="submit" id="submitButton" name="update" value="Update"></td>
                    <td><input type="reset" name="cancel" value="Batal" onclick="resetForm()"></td>
                </tr>
            </table>
        </form>
    </div>

    <h1>Data Barang</h1>
    <table class="second" border=1>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['harga']."</td>";
            echo "<td>
                <a href='barang.php?aksi=update&id=".$row['id']."'>Edit</a> | 
                <a href='barang.php?aksi=delete&id=".$row['id']."'>Delete</a>
            </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="index.php">Kembali</a>    
</body>
</html>
