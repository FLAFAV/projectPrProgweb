<?php 
    require_once "../Connection.php";
    if (isset($_GET['id']) && isset($_GET['tgl'])){
        $informasiKegiatan = getInformasi($_GET['id']);
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

        // $d = strtotime($informasiKegiatan[0]["tglMulai"]);
        $tanggalSekarang = explode("-", $_GET["tgl"]);
        $bulanMulai = $tanggalSekarang[1];
        $bulanMulai = $NAMA_BULAN[$bulanMulai];
        $hariMulai = $tanggalSekarang[2];
        $tahunMulai = $tanggalSekarang[0];
    }
    else {
        header("location:../index.php");
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakom</title>
    <link rel="stylesheet" href="style.css">
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
            <table class="kegiatan">
            <tr>
                <th colspan="7" class = "tgl-bulan-tahun">
                    <h3><?php echo "$hariMulai $bulanMulai $tahunMulai"?></h3>
                </th>
            </tr>
            <tr class ="hari-hari">
                <th colspan="7"><?php echo $informasiKegiatan[0]["nama"];?></th>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\penting.png" alt="">
                    &nbsp; Level Penting 
                </td>
                <td><?php echo $informasiKegiatan[0]["level"];?></td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Mulai
                </td>
                <td><?php echo date($informasiKegiatan[0]["tglMulai"])?></td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Selesai
                </td>
                <td><?php echo date($informasiKegiatan[0]["tglSelesai"])?></td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\jam.png" alt="">
                    &nbsp; Durasi

                </td>
                <td><?php echo $informasiKegiatan[0]["durasi"] . " menit"?> </td>
            </tr>
            
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\gps.png" alt="">
                    &nbsp; Lokasi
                </td>
                <td><?php echo $informasiKegiatan[0]["lokasi"]?></td>
            </tr>
            <tr>
                <!-- <td class = "go-back">
                    <a href="../to-kegiatan/satu.html">Go Back</a>
                </td> -->
                <td class="go-back" colspan="2">
                    <a href="../index.php">
                        <img class="simbol-penting" src="../gambar/home.png" alt="">
                    </a>
                </td>
            </tr>
            <!-- <tr>
                <td colspan="7"></td>
            </tr> -->
            </table>
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

</body>
</html>