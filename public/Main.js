const HARI_HARI = document.getElementsByClassName("hari")
const NAMA_BULAN = {
    1: "JANUARI",
    2:"FEBRUARI",
    3: "MARET",
    4: "APRIL",
    5: "MEI",
    6: "JUNI",
    7: "JULI",
    8: "AGUSTUS",
    9: "SEPTEMBER",
    10: "OKTOBER",
    11: "NOVEMBER",
    12: "DESEMBER"
}
var bulanDiKalender;
var tahunDiKalender;
function getJumlahHari(year, month){
    month --; //karena bulan dan hari di js mulai dari 0 wtf
    let date = new Date(year, month, 31);
    if (date.getDate() == 31)
        return 31;
    else if (date.getDate() == 1)
        return 30;
    else {
        if (date.getFullYear() % 4 == 0)
            return 29;
        else
            return 28;
    }
}

function kasihOverLine(kegiatan) {
    for (i = 0 ; i < kegiatan.length ; i++) {
        tgl = kegiatan[i][0]['tgl'];
        // console.log(tgl);
        // tanggal = document.getElementById(tgl);
        // let path = "../../projectPrProgweb/kegiatan/rplbo2.php?id=" + kegiatan[i][0]['id'];
        let now = new Date();
        for (j = 0 ; j < kegiatan[i].length ; j++) {
            tgl = kegiatan[i][j]['tgl'];
            let path = "../../projectPrProgweb/kegiatan/rplbo2.php?id=" + kegiatan[i][j]['id'] + "&tgl=" + kegiatan[i][j]['bulan'];
            let path2 = "../../projectPrProgweb/kegiatan/insert.php?" + "tgl=" + kegiatan[i][j]['bulan'];
            tanggal = document.getElementById(tgl);
            // tanggal.innerHTML = tanggal.id;
            // alert(tgl);
            if (!isNaN(Number(tanggal.innerHTML))) {
                tanggal.innerHTML = 
                "<span class='ada-tugas'>" + tanggal.id +"</span>"+
                "<div class='dropdown-container'><span class = 'kegiatan'>Kegiatan</span>"+ 
                "<a class='dropdown keg " + kegiatan[i][j]['level'] +"'" +" href= " +path+ "  >" + kegiatan[i][j]['nama']+"</a></div>";
            }
            else if (!tanggal.innerHTML.includes("<span class=\"ada-tugas\">")) {
                tanggal.innerHTML = 
                "<span class='ada-tugas'>" + tanggal.id +"</span>"+
                "<div class='dropdown-container'><span class = 'kegiatan'>Kegiatan</span>"+ 
                "<a style='background-color:white;' class='dropdown keg ' " + " href=" +path2+"> Tambah+ </a><br>"+
                "<a class='dropdown keg " + kegiatan[i][j]['level'] +"'" +" href= " +path+ "  >" + kegiatan[i][j]['nama']+"</a></div>";
                
                let className = "container-ada-tugas";
                if (tanggal.id == now.getDate() && tahunDiKalender == now.getFullYear() && bulanDiKalender == (now.getMonth() +1)){
                    className += " now";
                    
                }
                tanggal.className = className;
            }
            else  {
                
                tanggal.innerHTML = tanggal.innerHTML.slice(0, -6)+ "<br>"+
                "<a class='dropdown keg " + kegiatan[i][j]['level'] +"'" +" href= " +path+ "  >" + kegiatan[i][j]['nama']+"</a></div>";   
            }
        }
    }

}


function isiTanggal(tahun,bulan, kegiatan=[]){

    let date = new Date(tahun, bulan-1, 1);
    let jumlahHari = getJumlahHari(tahun, bulan);
    let date2 = new Date(tahun, bulan-2, 1);
    let lastTglBulanSblm = getJumlahHari(date2.getFullYear(), date2.getMonth() + 1);
    
    let hariMulai = date.getDay() - 1
    if (hariMulai < 0)
        hariMulai = 6;  

    let now = new Date() 
    today = now.getDate()
    sudahLewatNow = false;
    baris = 6
    kolom = 7
    hari = 1
    for (i = 0; i < baris; i++){
        for (j = 0; j < kolom; j++){
            if (j < hariMulai && i == 0){
                HARI_HARI[i].children[j].innerHTML = lastTglBulanSblm + j - hariMulai +1;
                HARI_HARI[i].children[j].className = "sisa";
                HARI_HARI[i].children[j].id = null;
                continue; 
            }
                
            if (hari <= jumlahHari){
                var tanggal = tahun + "-" + bulan + "-" + hari;
                // console.log(tanggal);
                HARI_HARI[i].children[j].id = hari;
                if (new Date(now.getFullYear(), now.getMonth(), now.getDate()) < new Date(tahun, bulan-1, hari)) {
                    HARI_HARI[i].children[j].innerHTML = hari +       
                    "<div class='dropdown-container'><span class = 'kegiatan'>Kegiatan</span>"+ 
                    "<a style='background-color:white;' class='dropdown keg '  href='../../projectPrProgweb/kegiatan/insert.php?tgl="+ tanggal+"'> Tambah+ </a><br>";
                }
                else {
                    HARI_HARI[i].children[j].innerHTML = hari;
                }
                HARI_HARI[i].children[j].className = "hariBiasa";

                
                // hari == today && now.getMonth() == bulan-1 && now.getFullYear() == tahun
                if (hari == today && now.getMonth() == bulan-1 && now.getFullYear() == tahun) {
                    console.log(new Date(tahun, bulan-1, hari));
                    HARI_HARI[i].children[j].className = "now";
                    sudahLewatNow = true;
                    HARI_HARI[i].children[j].innerHTML = hari +       
                    "<div class='dropdown-container'><span class = 'kegiatan'>Kegiatan</span>"+ 
                    "<a style='background-color:white;' class='dropdown keg '  href='../../projectPrProgweb/kegiatan/insert.php?tgl="+ tanggal+"'> Tambah+ </a><br>";
                }
                hari++;
            }
        
           
            else {
                HARI_HARI[i].children[j].innerHTML = hari - jumlahHari;
                HARI_HARI[i].children[j].className = "sisa dropdown";
                hari ++;
            }
        }
    }
    document.getElementById("bulan").innerHTML = NAMA_BULAN[bulan];
    document.getElementById("tahun").innerHTML = tahun;
    bulanDiKalender = bulan;
    tahunDiKalender = tahun;

    kasihOverLine(kegiatan);
 
    }


const body = document.body
let date = new Date()


function getBulan () {
    return bulanDiKalender;
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}   

var prev = document.getElementById("prev");
prev.addEventListener('click', function() {

    bulanDiKalender--;
    if (bulanDiKalender > 12) {
        tahunDiKalender ++;
        bulanDiKalender = 1;
    }
    else if (bulanDiKalender < 1) {
        tahunDiKalender --;
        bulanDiKalender = 12;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
        isiTanggal(tahunDiKalender, bulanDiKalender, JSON.parse(xhr.responseText));
    }
}
    xhr.open("GET", "ajaks.php?bulan="+bulanDiKalender+"&tahun="+tahunDiKalender, true);
    xhr.send();
})
var next = document.getElementById("next");
next.addEventListener("click", function() {
    // apalah = Number(readCookie("bulan")) +1;
    // // alert(apalah);
    // document.cookie = "bulan="+apalah;
    bulanDiKalender++;
    if (bulanDiKalender > 12) {
        tahunDiKalender ++;
        bulanDiKalender = 1;
    }
    else if (bulanDiKalender < 1) {
        tahunDiKalender --;
        bulanDiKalender = 12;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
        isiTanggal(tahunDiKalender, bulanDiKalender, JSON.parse(xhr.responseText));
    }
}
    xhr.open("GET", "ajaks.php?bulan="+bulanDiKalender+"&tahun="+tahunDiKalender, true);
    xhr.send();
})
// alert(getJumlahHari(2023, 12));
