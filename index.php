<?php
include 'koneksi.php';

// Ambil data barang, pembeli, dan kurir dari database
$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$pembeli = mysqli_query($koneksi, "SELECT * FROM pembeli");
$kurir = mysqli_query($koneksi, "SELECT * FROM kurir");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
        }
        table {  
            margin: 2px;
        }
        th, td { 
            border: 1px solid black; 
            padding: 8px; 
            text-align: left; 
        }
        table:hover { 
            background-color: #f5f5f5; 
            cursor: pointer; 
        }
    </style>
    <script>
        function redirect(url) {
            window.location.href = url;
        }
    </script>
</head>
<body>
    <div class="container">
        <div onclick="redirect('barang.php')">
            <table border=1>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1; // Inisialisasi nomor urut untuk tabel barang
                    while ($row = mysqli_fetch_assoc($barang)) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>"; // Menampilkan nomor urut
                        echo "<td>".$row['id']."</td>"; // Menampilkan ID
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>        
        <div onclick="redirect('pembeli.php')">
            <table border=1>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pembeli</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($pembeli)) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row['id']."</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div onclick="redirect('kurir.php')">
            <table border=1>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Kurir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($kurir)) {
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>".$row['id']."</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>