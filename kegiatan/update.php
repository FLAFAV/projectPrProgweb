<?php
    session_start();
    require_once "../LoginKoneksi.php";
    $HOST = "localhost";
    $PASSWORD = "";
    $USER = "root";
    $DB = "kalender";
    $pengguna = $_SESSION['username'];
    $conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
    if (!$conn->get_connection_stats())
        die("Failed");
    // if (!isset($_GET['tgl'])) {
    //     header("location:../index.php");
    // }
    $id = $_GET['id'];
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
    $sql = "SELECT * FROM kegiatan WHERE id = " . $_GET['id'] . " AND username =" . "'".$pengguna."'";
    $tgl = explode("-", $_GET['tgl']);
    $hari = $tgl[2];
    $bulan = $tgl[1];
    if (strlen($bulan) == 1) {
        $bulan = "0" . $bulan;
    }
    $bulan = $NAMA_BULAN[$bulan];
    $tahun = $tgl[0];
    $old_nama;
    $old_tglMulai = "$tahun-" . $tgl[1] . "-$hari";
    $old_tglSelesai;
    $old_level;
    $old_durasi;
    $old_lokasi;
    $old_gambar;

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $old_nama = $row['nama'];
        $old_tglMulai = $row['tglMulai'];
        $old_tglSelesai = $row['tglSelesai'];
        $old_durasi = explode(" ", $row['durasi']);
        $old_lokasi = $row['lokasi'];
        $old_level = $row['level'];
        $old_gambar = $row['gambar'];
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
    if (strlen($hari) == 1) {
        $hari = "0" . $hari;
    }
    $bulan = $NAMA_BULAN[$bulan];
    $tahun = $tgl[0];

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $tglMulai = $_POST['mulai'];
        $tglSelesai = $_POST['selesai'];
        $level = $_POST['level'];
        $durasi = $_POST['durasiJam'] . " jam " . $_POST['durasiMenit']." menit";
        $lokasi = $_POST['lokasi'];
        $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', 'pp')";
        if (($_FILES['img']['name'] == '')) 
        {
            $sql = "UPDATE `kegiatan` SET nama = '$nama',
            tglMulai='$tglMulai',
            tglSelesai='$tglSelesai',
            level='$level',
            durasi='$durasi',
            lokasi='$lokasi'
            WHERE id =$id AND username = '$pengguna'"
            ;
            mysqli_query($conn, $sql);

        }
        else {
            echo $_FILES['img']['name'];
            $extension = pathinfo($_FILES['img']['name'])['extension'];
            $uploadfile = "upload/" . time() . ".".$extension;
            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
                $sql = "UPDATE `kegiatan` SET nama = '$nama',
                tglMulai='$tglMulai',
                tglSelesai='$tglSelesai',
                level='$level',
                durasi='$durasi',
                lokasi='$lokasi',
                gambar='$uploadfile'
                WHERE id =$id AND username = '$pengguna'"
                ;
                mysqli_query($conn, $sql);
    

                unlink($old_gambar);
            }
            else {
                echo $_FILES['img']['name'];
            //     echo "<script>
            //     alert('GAGAL UPLOAD FILE')
            // </script>";
            }

        }
        header("location:../kegiatan/rplbo2.php?id=".$_GET['id']."&tgl=".$_GET['tgl']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakom</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <link rel="icon" type="image/x-icon" href="../gambar/fav.png">

</head>
<style>
    .kegiatan td:nth-child(even){
    opacity: 1;
    text-align: center;
    }
    .wajib {
        color: red;
    }

</style>
<body>
    <header>
        <nav>
            <div class="brand">
                Kalender
            </div>
            <ul>
                <li><a href="">Hello, <?php echo $_SESSION['username'];?></a></li>
                <li><a href="../logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class ="container">
            <form action="" method="POST" onsubmit="return validation()" enctype= multipart/form-data>
                <table class="kegiatan">
                <tr>
                    <th colspan="7" class = "tgl-bulan-tahun">
                        <h3><?php echo "$hari $bulan $tahun"?></h3>
                    </th>
                </tr>
                <tr class ="hari-hari">
                    <th colspan="7" >
                        <input id = 'errorKegiatan' type="text" name="nama" placeholder="Masukkan nama kegiatan" value="<?php echo $old_nama ?>">
                        <span class='wajib'>*</span>
                    </th>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\penting.png" alt="">
                        &nbsp; Level Penting 
                    </td>
                    <td>
                        <select name="level" id="" value='<?php echo $old_level ?>'>
                            <option value="kurang">kurang</option>
                            <option value="sedang">sedang</option>
                            <option value="penting">penting</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                        &nbsp; Mulai
                    </td>
                    <td>
                        
                        <input id = "mulai" type="date" name= "mulai" value='<?php echo $old_tglMulai ?>'>


                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                        &nbsp; Selesai

                    </td>
                    <td>
                        <input id="selesai" type="date" name="selesai" value='<?php echo $old_tglSelesai ?>'>
                        <script>
                            document.getElementById("mulai").addEventListener('change', function () {
                                document.getElementById("selesai").min = document.getElementById("mulai").value;
                                if (document.getElementById("selesai").value < document.getElementById("mulai").value){
                                    document.getElementById("selesai").value = document.getElementById("mulai").value;
                                }
                            })
                            document.getElementById("selesai").min = document.getElementById("mulai").value;
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\jam.png" alt="">
                        &nbsp; Durasi

                    </td>
                    <td>

                        <input style="max-width:30px;" min="0" type="number" name="durasiJam" value='<?php echo $old_durasi[0]; ?>'>&nbsp;Jam
                        <input style="max-width:30px;" min = "0" type="number" name="durasiMenit" value="<?php echo $old_durasi[2]; ?>" >&nbsp;Menit

                    </td>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <img class = "simbol-penting" src="..\gambar\gps.png" alt="">
                        &nbsp; Lokasi
                    </td>
                    <td>
                        <input id="errorLokasi" type="text" name="lokasi" placeholder="Masukkan lokasi" value='<?php echo $old_lokasi ?>'>
                        <span class='wajib'>*</span>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td colspan=2>
                        <input type="file" name="img" id="img" value='<?php if ($old_gambar != 'pp') echo $old_gambar?>'>
                    </td>

                </tr>
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
                        <input type="submit" value="update" name="submit">
                    </td>
                    

                </tr>

                </table>
            </form>
                <table class="kegiatan" style="display:<?php if ($old_gambar == 'pp') {$old_gambar='upload/pp.png';echo 'none';}?>;">
                    <tr>
                        <td>
                            <img id = "gambar-kakom" class ="gambar-kakom" src="<?php echo $old_gambar?>" alt="">
                            
                        </td>
                    </tr>
                </table>
            
        </div>
    </main>
    <!-- <footer>
        <img class="ukdw" src="../gambar/33.UKDW.png" alt="">
        <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
    </footer> -->
    <script>
        function validation () {
            kegiatan =document.getElementById('errorKegiatan');
            lokasi =document.getElementById('errorLokasi');
            errors = [kegiatan, lokasi];
            wajib = document.getElementsByClassName('wajib');
            isValid = true;
            for (i = 0; i < errors.length ; i++)
            {
                if (errors[i].value == '') {
                    wajib[i].innerHTML = 'Tidak Boleh Kosong';
                    isValid = false;
                }
                else {
                    if (wajib[i].innerHTML = 'Tidak Boleh Kosong') {
                        wajib[i].innerHTML = "*";
                    }
                }

            }
            return isValid;
        }

    </script>


</body>
</html>