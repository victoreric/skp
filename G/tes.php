<?php
// $capaian_kuan_iki=130;
// if($capaian_kuan_iki>100){
//     $kategori_kuan_iki="Sangat Baik";
// }
// else if ($capaian_kuan_iki==100){
//     $kategori_kuan_iki="Baik";
// }
// else if ($capaian_kuan_iki<=99){
//     $kategori_kuan_iki="cukup";
// }
// else if ($capaian_kuan_iki<=80){
//     $kategori_kuan_iki="Kurang";
// }
// else if ($capaian_kuan_iki<=60){
//     $kategori_kuan_iki="Sangat Kurang";
// }

// else if ($capaian_kuan_iki<=99 AND $capaian_kuan_iki>=80 ){
//     $kategori_kuan_iki="Cukup";
// }
// else if ($capaian_kuan_iki<=79 AND $capaian_kuan_iki>=60){
//     $kategori_kuan_iki="Kurang";
// }
// else if ($capaian_kuan_iki<=59){
//     $kategori_kuan_iki="Sangat Kurang";
// };

$realisasi_kuan=9;
$target_kuan_min=10;
$target_kuan_max=15;

if($realisasi_kuan>=$target_kuan_min AND $realisasi_kuan<=$target_kuan_max){
    $capaian_kuan_iki=100;
}elseif ($realisasi_kuan<=$target_kuan_min){
    $capaian_kuan_iki=($realisasi_kuan/$target_kuan_min)*100;
}elseif ($realisasi_kuan>=$target_kuan_max){
    $capaian_kuan_iki=($realisasi_kuan/$target_kuan_max)*100;
};

echo $capaian_kuan_iki

?>