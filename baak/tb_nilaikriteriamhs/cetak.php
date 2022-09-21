<?php

//Mengaktifkan output buffering
ob_start();

include "config.php";


?>

<!DOCTYPE html>
<html>

<head>
    <title>GOLONGAN UKT MAHASISWA PNC</title>
    <style type="text/css">
        @page {
            margin-top: 1.54cm;
            margin-bottom: 2.54cm;
            margin-left: 2.175cm;
            margin-right: 2.175cm;
        }

        td {
            padding: 3px 3px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['periode']) && $_GET['periode'] != '') {
        $datatahunakademi = mysqli_query($koneksi, "select * from periode where id_periode='$_GET[periode]'");
    } else {
        $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
        $per = mysqli_fetch_assoc($ceknowperiode);
        $datatahunakademi = mysqli_query($koneksi, "select * from periode where id_periode='$per[id_periode]'");
    }

    $akademi = mysqli_fetch_assoc($datatahunakademi);
    ?>

    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%;"><span style="font-family:'Bookman Old Style';">MAHASISWA BARU POLITEKNIK NEGERI CILACAP</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%;"><span style="font-family:'Bookman Old Style';"><?= $akademi['nama_periode'] ?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center;">&nbsp;</p>
    <?php
    $dataprodi = mysqli_query($koneksi, "select * from tb_prodi");
    while ($rowprodi = mysqli_fetch_array($dataprodi)) {
    ?>

        <p style="margin:0pt; padding-left:0pt;" type="1">
            <span style="font-family:'Bookman Old Style';text-transform: uppercase;">PROGRAM STUDI <?= $rowprodi['nama_prodi'] ?></span>
        </p>
        <table cellpadding="0" cellspacing="0" style="border:0.75pt solid #000000; border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="width:21pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;">NO.</p>
                    </td>
                    <td style="width:100.2pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;">NIM</p>
                    </td>
                    <td style="width:181.25pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;">NAMA MAHASISWA</p>
                    </td>
                    <td style="width:131.25pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;">GOLONGAN UKT</p>
                    </td>
                    <td style="width:131.25pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;">NOMINAL UKT</p>
                    </td>
                </tr>
                <?php

                if (isset($_GET['periode']) && $_GET['periode'] != '') {
                    $data = mysqli_query($koneksi, "SELECT tb_mahasiswa.nama_mhs, tb_mahasiswa.NIM, tb_prodi.nama_prodi,v_hasilakhir.nilai_akhir,(SELECT tb_levelukt.nama_level   FROM tb_levelukt where tb_levelukt.id_periode=" . $_GET['periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as golongan_ukt, (SELECT tb_levelukt.ukt   FROM tb_levelukt where tb_levelukt.id_periode=" . $_GET['periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as nominal_ukt from tb_mahasiswa left join v_hasilakhir ON tb_mahasiswa.id_mhs=v_hasilakhir.id_mhs LEFT JOIN tb_prodi on tb_prodi.id_prodi=tb_mahasiswa.id_prodi where tb_mahasiswa.id_periode=" . $_GET['periode'] . " AND tb_mahasiswa.id_prodi=$rowprodi[id_prodi] order by ABS(tb_mahasiswa.NIM) asc");
                } else {
                    $data = mysqli_query($koneksi, "SELECT tb_mahasiswa.nama_mhs, tb_mahasiswa.NIM, tb_prodi.nama_prodi,v_hasilakhir.nilai_akhir,(SELECT tb_levelukt.nama_level   FROM tb_levelukt where tb_levelukt.id_periode=" . $per['id_periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as golongan_ukt, (SELECT tb_levelukt.ukt   FROM tb_levelukt where tb_levelukt.id_periode=" . $per['id_periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as nominal_ukt from tb_mahasiswa left join v_hasilakhir ON tb_mahasiswa.id_mhs=v_hasilakhir.id_mhs LEFT JOIN tb_prodi on tb_prodi.id_prodi=tb_mahasiswa.id_prodi where tb_mahasiswa.id_periode=" . $per['id_periode'] . " AND tb_mahasiswa.id_prodi=$rowprodi[id_prodi] order by ABS(tb_mahasiswa.NIM) asc");
                }
                $i = 1;
                while ($row = mysqli_fetch_array($data)) {
                ?>
                    <tr>
                        <td style="width:21pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;"><?php echo $i ?></p>
                        </td>
                        <td style="width:100.2pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;"><?php echo $row['NIM']; ?></p>
                        </td>
                        <td style="width:181.25pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;"><?php echo $row['nama_mhs']; ?></p>
                        </td>
                        <td style="width:131.25pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;"><?php echo $row['golongan_ukt'] ? $row['golongan_ukt'] : "Belum didata"; ?></p>
                        </td>
                        <td style="width:131.25pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; widows:0; orphans:0; font-size:10pt;"><?php echo $row['nominal_ukt'] ? $row['nominal_ukt'] : "Belum didata"; ?></p>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                $rowcount = mysqli_num_rows($data);
                if ($rowcount < 1) {
                    echo "<tr><td colspan='4'><center>Tidak Ada Data</center></td></tr>";
                }
                ?>
            </tbody>
        </table>

        <p style="margin-top:0pt; margin-bottom:0pt;">&nbsp;</p>
    <?php } ?>
</body>

</html>

<?php

//Meload library mPDF
require '../../vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 25, 'margin_right' => 25]);

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->Output("CETAK.pdf", "D");

?>