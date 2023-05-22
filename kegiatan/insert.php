<!DOCTYPE html>
<?php
    setcookie("bulan", "halo");
    $HOST = "localhost";
    $PASSWORD = "";
    $USER = "root";
    $DB = "kalender";
    
    $conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
    if (!$conn->get_connection_stats())
        die("Failed");
    if (!isset($_GET['tgl'])) {
        header("location:../index.php");
    }
    $NAMA_BULAN = array(
        "01"=> "JANUARI",
        "02"=>"FEBRUARI",
        "03"=>"MARET",
        "04"=> "APRIL",
        "05"=> "MEI",
        "06"=> "JUNI",
        "07"=> "JULI",
        "08"=> "AGUSTUS",
        "09"=> "SEPTEMBER",
        "10"=> "OKTOBER",
        "11"=>"NOVEMBER",
        "12"=>"DESEMBER"
    );
    $tgl = explode("-", $_GET['tgl']);
    $hari = $tgl[2];
    $bulan = $tgl[1];
    if (strlen($bulan) == 1) {
        $bulan = "0" . $bulan;
    }
    $bulan = $NAMA_BULAN[$bulan];
    $tahun = $tgl[0];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakom</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <link rel="icon" type="image/x-icon" href="../gambar/fav.png">

</head>
<body>
    <header>
        <div class = "judul">
            Kegiatan
        </div>
    </header>
    <main>
        <div class ="container">
            <form action="" method="POST">
                <table class="kegiatan">
                <tr>
                    <th colspan="7" class = "tgl-bulan-tahun">
                        <h3><?php echo "$hari $bulan $tahun"?></h3>
                    </th>
                </tr>
                <tr class ="hari-hari">
                    <th colspan="7">
                        <input type="text" name="nama" placeholder="Masukkan nama kegiatan">
                    </th>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\penting.png" alt="">
                        &nbsp; Level Penting 
                    </td>
                    <td>
                        <input type="text" name = "level" placeholder="Masukkan level">
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                        &nbsp; Mulai
                    </td>
                    <td>
                        <?php echo "$hari-".$tgl[1] . "-$tahun"?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                        &nbsp; Selesai
                    </td>
                    <td>
                        <input type="date" name="selesai">
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\jam.png" alt="">
                        &nbsp; Durasi

                    </td>
                    <td>
                        <input type="text" name="durasi" placeholder="Masukkan durasi">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\gps.png" alt="">
                        &nbsp; Lokasi
                    </td>
                    <td>
                        <input type="text" name="lokasi" placeholder="Masukkan lokasi">
                    </td>
                </tr>
                <tr>
                    <!-- <td class = "go-back">
                        <a href="../to-kegiatan/delapanbelas.html">Go Back</a>
                    </td> -->
                    <td class="go-back">
                        <a href="../index.php">
                            <img class = "simbol-penting" src="../gambar/home.png" alt="">
                            
                        </a>
                        

                    </td>
                    <td>
                        <input type="submit" value="Kirim" name="submit">
                    </td>

                </tr>

                </table>
            </form>
                <table class="kegiatan">
                    <tr>
                        <td>
                            <img class ="gambar-kakom" src="../gambar/didaktos.png" alt="">
                        </td>
                    </tr>
                </table>
            
        </div>
    </main>
    <footer>
        <img class="ukdw" src="../gambar/33.UKDW.png" alt="">
        <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
    </footer>

    <?php

        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $tglMulai = "$tahun-" . $tgl[1] . "-$hari";
            $tglSelesai = $_POST['selesai'];
            $level = $_POST['level'];
            $durasi = $_POST['durasi'];
            $lokasi = $_POST['lokasi'];
            $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', 'pp')";
            mysqli_query($conn, $sql);
        }
    ?>

</body>
</html>