
<?php
    
    $HOST = "localhost";
    $PASSWORD = "";
    $USER = "root";
    $DB = "kalender";
    
    $conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
    if (!$conn->get_connection_stats())
        die("Failed");

    function getKegiatan($tahun, $bulan) {
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN,$bulan, $tahun);
        $arrayResult=[];
        $conn=$GLOBALS['conn'];
        for ($i = 1; $i < $jumlahHari +1; $i++) {
            $query = "SELECT * FROM (select *,'$tahun-$bulan-$i' as bulan from kegiatan) as g where bulan BETWEEN tglMulai and tglSelesai;";
            $result = mysqli_query($conn, $query);
            $array = [];
            $uniqueID = [];
            while (($row = mysqli_fetch_assoc($result))) {
                    if (!in_array($row['id'], $uniqueID)) {
                        array_push($uniqueID, $row['id']);
                        $row['tgl'] = $i;
                        array_push($array, $row);
                    }
            }
            foreach($array as $j) {
                
                array_push($arrayResult, $array);
                break;
            }
        }

        return json_encode($arrayResult);
    }

    function getInformasi($id) {

        $conn = $GLOBALS['conn'];
        $sql = "SELECT id, nama, level, DATE(tglSelesai) as tglSelesai, DATE(tglMulai) as tglMulai,
        level, 
        YEAR(tglMulai) as tahunMulai,
        MONTH(tglMulai) as bulanMulai, durasi, lokasi, gambar FROM kegiatan WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $arrayResult = [];
        while (($row = mysqli_fetch_assoc($result))) {
            array_push($arrayResult, $row);
        }
        return $arrayResult;

    }
    
    // echo(getKegiatan(5));
    // SELECT bulan, tglMulai, tglSelesai FROM (select "2023-05-19" as bulan, tglMulai, tglSelesai from kegiatan) as g where bulan BETWEEN tglMulai and tglSelesai;
    //SELECT * FROM (select *,"2023-05-19" as bulan from kegiatan) as g where bulan BETWEEN tglMulai and tglSelesai;


    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    echo getKegiatan($tahun, $bulan);
?>

