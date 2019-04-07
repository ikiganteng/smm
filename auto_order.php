<?php
require_once 'class_curl.php';
date_default_timezone_set("Asia/Jakarta");
function read ($length='255') 
{ 
   if (!isset ($GLOBALS['StdinPointer'])) 
   { 
      $GLOBALS['StdinPointer'] = fopen ("php://stdin","r"); 
   } 
   $line = fgets ($GLOBALS['StdinPointer'],$length); 
   return trim ($line); 
} 

function nama($link,$apiid,$apikey,$service){
    $page = curl($link."/services","api_id={$apiid}&api_key={$apikey}",$cookie);
    $hasil = json_decode($page);
    foreach ($hasil->data as $item) {
	if ($item->id == $service) {
    return $item->name;
}
}
}

function saldo($link,$apiid,$apikey){
    $page = curl($link."/profile","api_id={$apiid}&api_key={$apikey}",$cookie);
    $hasil = json_decode($page);
    return $hasil->data->balance;
}

function orders($link,$apiid,$apikey,$service,$empass){
    list($target,$jumlah) = explode("|", $empass);
    $page = curl($link."/order","api_id={$apiid}&api_key={$apikey}&service={$service}&target={$target}&quantity={$jumlah}",$cookie);
    $hasil = json_decode($page);
	if ($hasil->status == false) {
    return 'Gagal | Link :'.$target.' | Jumlah :'.$jumlah.' | Reason :'.$hasil->data;
}   else if ($hasil->status == true) {
    return 'Sukses | Link :'.$target.' | Jumlah :'.$jumlah.' | ID :'.$hasil->data->id.' | Harga :Rp.'.$hasil->data->price.' | Order at '.date("d/m/Y g:i A");
}   else {
    return 'Tidak diKetahui | Link :'.$target.' | Jumlah :'.$jumlah;
}
}
//echo "### Created by IKIGANTENG ###";
echo "\n";
echo "[?] Link API   : ";
$link = read();
echo "[?] API ID     : ";
$apiid = read();
echo "[?] API KEY    : ";
$apikey = read();
echo "[?] Service ID : ";
$service = read();
echo "[?] list       : ";
$list = read();
echo "\n";
$awal = "Saldo awal Rp.".saldo($link,$apiid,$apikey)."\n";
echo $awal;
$nama = nama($link,$apiid,$apikey,$service);
echo "Mencoba mengorder ".$nama."... \n";
echo "\n";
$file = file_get_contents($list);
$data = explode("\n",$file);
for($a=0;$a<count($data);$a++){
    $email =  $data[$a];
    echo "[+] ".orders($link,$apiid,$apikey,$service,$email)."\n";
}
echo "\n";
$akhir = "Sisa saldo Rp.".saldo($link,$apiid,$apikey)."\n";
echo $akhir;
//$sisa = $awal-$akhir;
//echo "Jumlah saldo terpakai Rp.".$sisa."\n";
