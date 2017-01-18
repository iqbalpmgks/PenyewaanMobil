<?php
if(date("Y-m-d") >= date("2016-12-29")){ // Jika tanggal sekarang lebih besar sama dengan tanggal pengembalian
  $pengembalian = date("Y-m-d H:i:s", strtotime($tgl_selesai." ".$jam_keluar)); // inisialiasi dengan waktu
  $tgl_skrg = date("Y-m-d H:i:s"); // inisialisasi dengan waktu
  if($tgl_skrg > $pengembalian){ // jika tanggal&waktu sekarang lebih besar dari tanggal&waktu pengembalian
    $from_time = strtotime($tgl_skrg);
    $to_time = strtotime($pengembalian);
    $tot = round(abs($from_time - $to_time) / 60,2);
    $tot2 =  round($tot/ 60);
    if($tot > $tot2){ // pembulatan jam
      $tot2 = $tot2+1;
    }
  }
}
    echo $tot2;
?>
