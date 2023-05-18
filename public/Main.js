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
    kegiatan.sort(function(a, b) {
        return a - b;
      });
    let n = 0;
    let baris = 6
    let kolom = 7
    let now = new Date();
    let hari;

    for (i = 0; i < baris; i++){
        for (j = 0; j < kolom; j++){
            if (HARI_HARI[i].children[j].className == "sisa" ) {
                continue;
            }
            else {
                
                hari = HARI_HARI[i].children[j].innerHTML;
                if (kegiatan[n] == hari) {
                    let className = "ada-tugas";
                    if (hari == now.getDate()){
                        className += " now";
                    }
                    HARI_HARI[i].children[j].className = className;
                    n++;
                }
                


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

    baris = 6
    kolom = 7
    hari = 1
    for (i = 0; i < baris; i++){
        for (j = 0; j < kolom; j++){
            if (j < hariMulai && i == 0){
                HARI_HARI[i].children[j].innerHTML = lastTglBulanSblm + j - hariMulai +1;
                HARI_HARI[i].children[j].className = "sisa";
                continue; 
            }
                
            if (hari <= jumlahHari){
                HARI_HARI[i].children[j].innerHTML = hari;
                HARI_HARI[i].children[j].className = null;

                if (hari == today && now.getMonth() == bulan-1 && now.getFullYear() == tahun) 
                    HARI_HARI[i].children[j].className = "now";
                hari++;
            }
        
           
            else {
                HARI_HARI[i].children[j].innerHTML = hari - jumlahHari;
                HARI_HARI[i].children[j].className = "sisa";
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
function changeMonth(arah, kegiatan, defTime = new Date()){
    bulanDiKalender += arah
    if (bulanDiKalender <= 0){
        bulanDiKalender = 12
        tahunDiKalender-=1
    }
    else if (bulanDiKalender > 12){
        bulanDiKalender = 1
        tahunDiKalender+=1
    }
    if (defTime.getMonth() + 1 == bulanDiKalender && defTime.getFullYear() == tahunDiKalender)
        isiTanggal(tahunDiKalender, bulanDiKalender, kegiatan);
    else
        isiTanggal(tahunDiKalender, bulanDiKalender);

}

// alert(getJumlahHari(2023, 12));
