<!DOCTYPE html>
<?php 
    require_once "Connection.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <link rel="stylesheet" href="public/style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="gambar/fav.png">

</head>
<body>
    <!-- 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 -->
    <header>
        <div>
            Kalender
        </div>
    </header>
    <main>
        <div class ="container">
            <table class ="kalender">
                <tr>
                    <th >
                        <input type="button" value="&leftarrow;" onclick="changeMonth(-1, <?php echo getKegiatan(5); ?>)">
                    </th>
                    <th colspan="5" class = "bulan-tahun">
                        <h3><span id="bulan"></span > <span id="tahun"></span></h3>
                    </th>
                    <th>
                        <input type="button" value="&rightarrow;" onclick="changeMonth(1, <?php echo getKegiatan(5); ?>)">
                    </th>
                </tr>
                <tr class ="hari-hari">
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="hari">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- <tr class="hari">
                    <td colspan="7">
                        <div class="ngisor-dewe">
                            <div class="level-1"></div>
                            <span class="kurang">Kurang Penting</span>
                            <div class="level-2"></div>
                            <span class="sedang">Sedang</span>
                            <div class="level-3"></div>
                            <span class="penting">Penting</span>
                        </div>
                    </td>
                </tr> -->

            </table>

        </div>

    </main>
    <footer>
        <img class="ukdw" src="./gambar/33.UKDW.png" alt="">
        <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
    </footer>
    <script src="public/Main.js"></script>
    <script>
        isiTanggal(date.getFullYear(), date.getMonth()+1, <?php echo getKegiatan(5); ?>);
    </script>
</body>
</html>