<!DOCTYPE html>
<html>

<head>
    <title>Import Excel Ke MySQL dengan PHP - www.malasngoding.com</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        p {
            color: green;
        }
    </style>

    <h2>IMPORT EXCEL KE MYSQL DENGAN PHP</h2>
    <h3>www.malasngoding.com</h3>

    <?php
    if (isset($_GET['berhasil'])) {
        echo "<p>" . $_GET['berhasil'] . " Data berhasil di import.</p>";
    }
    ?>

    <a href="upload.php">IMPORT DATA</a>
    <table border="1">
        <tr>
            <th>
                <center>NIM</center>
            </th>
            <th>
                <center>Nama Mahasiswa</center>
            </th>
            <th>
                <center>Jenis Kelamin</center>
            </th>
            <th>
                <center>Prodi</center>
            </th>
            <th>
                <center>Jumlah Penghasilan Orang Tua</center>
            </th>
            <th>
                <center>Jumlah Assets</center>
            </th>
            <th>
                <center>Tanggungan</center>
            </th>
            <th>
                <center>Jarak Rumah</center>
            </th>
            <th>
                <center>Daya Listrik</center>
            </th>
            <th>
                <center>Sumber Air</center>
            </th>
            <th>
                <center>Jenis Pekerjaan Ayah</center>
            </th>
            <th>
                <center>Jenis Pekerjaan Ibu</center>
            </th>
        </tr>
        <?php
        include 'config.php';
        $no = 1;
        $data = mysqli_query($koneksi, "select * from tb_mahasiswa");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <th><?php echo $no++; ?></th>
                <td>
                    <?php echo $row['NIM']; ?>
                </td>
                <td>
                    <?php echo $row['nama_mhs']; ?>
                </td>
                <td>
                    <?php echo $row['jk']; ?>
                </td>
                <td>
                    <?php echo $row['prodi']; ?>
                </td>
                <td>
                    <?php echo $row['jml_penghasilan_ortu']; ?>
                </td>
                <td>
                    <?php echo $row['assets']; ?>
                </td>
                <td>
                    <?php echo $row['tanggungan']; ?>
                </td>
                <td>
                    <?php echo $row['jarak_rumah']; ?>
                </td>
                <td>
                    <?php echo $row['daya_listrik']; ?>
                </td>
                <td>
                    <?php echo $row['sumber_air']; ?>
                </td>
                <td>
                    <?php echo $row['jns_pekerjaan_ayah']; ?>
                </td>
                <td>
                    <?php echo $row['jns_pekerjaan_ibu']; ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>

    <a href="https://www.malasngoding.com/import-excel-ke-mysql-dengan-php">www.malasngoding.com</a>

</body>

</html>