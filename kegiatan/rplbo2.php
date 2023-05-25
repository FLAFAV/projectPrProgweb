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
        $sql = "SELECT * FROM kegiatan WHERE id = " . $_GET['id'];
        $result = mysqli_query($conn, $sql);
        $gambar = mysqli_fetch_assoc($result)['gambar'];
        // $d = strtotime($informasiKegiatan[0]["tglMulai"]);
        $tanggalSekarang = explode("-", $_GET["tgl"]);
        $bulanMulai = $tanggalSekarang[1];
        
        if (strlen($bulanMulai) == 1) {
            $bulanMulai = "0" . $bulanMulai;
        }
        $bulanMulai = $NAMA_BULAN[$bulanMulai];
        $hariMulai = $tanggalSekarang[2];
        if (strlen($hariMulai) == 1) {
            $hariMulai = "0" . $hariMulai;
        }
        $tahunMulai = $tanggalSekarang[0];
    }
    else {
        header("location:../index.php");
        
    }
    if (isset($_POST['update'])) {
        header("location:update.php?id=".$_GET['id'] . "&tgl=".$_GET['tgl']);
    }
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM kegiatan WHERE id = " .$_GET['id'];
        mysqli_query($conn, $sql);
        unlink($gambar);
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
    <link rel="stylesheet" href="style.css?v=<?php echo time()?>">
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
                <td><?php echo $informasiKegiatan[0]["durasi"] ?> </td>
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
                <td class="go-back" >
                    <a href="../index.php">
                        <img class="simbol-penting" src="../gambar/home.png" alt="">
                    </a>
                </td>
                <td>
                    <form action="" method="POST">
                        <input id="updateButton" type="submit" value="Update" name="update">
                        <input id="deleteButton" type="submit" value="Delete" name="delete">
                    </form>
                </td>
            </tr>
            <!-- <tr>
                <td colspan="7"></td>
            </tr> -->
            </table>
            <table id="gambarKegiatan" class="kegiatan" style="">
                <tr>
                    <td>
                        <img id = "gambar-kakom" class ="gambar-kakom" src="../gambar/didaktos.png" alt="">
                    </td>
                </tr>
            </table>
            <script>
                gambar = '<?php echo $gambar ?>'
                if (gambar == 'pp') {
                    document.getElementById('gambarKegiatan').style.display = "none";
                }
                else {
                    document.getElementById('gambar-kakom').src = gambar;
                }
            </script>

        </div>
    </main>
    <footer>
        <img class="ukdw" src="../gambar/33.UKDW.png" alt="">
        <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
    </footer>
    <script>
        button = document.getElementById("updateButton");
        button2 =document.getElementById("deleteButton");
        tglSelesai = new Date('<?php echo date($informasiKegiatan[0]["tglSelesai"])?>');
        now = new Date();
        if (tglSelesai < new Date(now.getFullYear(), now.getMonth(), now.getDate())){
            // button.disabled = true;
            button2.disabled = true;
            // button.title = "Tanggal sudah lewat, tidak bisa update";
            button2.title = "Tanggal sudah lewat, tidak bisa delete";
        }


    </script>
</body>
</html>