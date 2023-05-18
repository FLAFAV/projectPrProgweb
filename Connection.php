<?php
    $HOST = "localhost";
    $PASSWORD = "";
    $USER = "root";
    $DB = "kalender";

    $conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);
    if (!$conn->get_connection_stats())
        die("Failed");

    function getKegiatan($month) {
        $conn=$GLOBALS['conn'];

        $query = "SELECT DAY(tglSelesai) as tglSelesai FROM `kegiatan` WHERE MONTH(tglMulai) = $month";
        $result = mysqli_query($conn, $query);
        $arrayResult = [];
        while (($row = mysqli_fetch_assoc($result))) {
            array_push($arrayResult, $row);
        }

        $hasil = "[";
        foreach($arrayResult as $value) {
            $hasil .= $value["tglSelesai"] . ",";
        }
        $hasil = substr($hasil, 0, strlen($hasil)-1);
        $hasil .= "]";
        return $hasil;
    }

    // echo(getKegiatan(5));
?>