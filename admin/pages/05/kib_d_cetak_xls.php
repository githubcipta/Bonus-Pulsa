<?php
set_time_limit(0);
include('kibd_xls.php');
$AcsDsc1 = cekPOST("AcsDsc1");
$AcsDsc2 = cekPOST("AcsDsc2");
$Asc1 = !empty($AcsDsc1)? " desc ":"";
$Asc2 = !empty($AcsDsc2)? " desc ":"";
$jmPerHal = cekPOST("jmPerHal");
$Main->PagePerHal = !empty($jmPerHal) ? $jmPerHal : $Main->PagePerHal;
$odr1 = cekPOST("odr1");
$odr2 = cekPOST("odr2");
$Urutkan = "";
if(!empty($odr1) && empty($odr2))
{$Urutkan = " $odr1 $Asc1, ";}
if(!empty($odr2) && empty($odr1))
{$Urutkan = " $odr2 $Asc2, ";}
if(!empty($odr2) && !empty($odr1))
{$Urutkan = " $odr1 $Asc1, $odr2 $Asc2, ";}

$HalKIB_D = cekPOST("HalKIB_D",1);
$ctk = cekGET("ctk");
$Main->PagePerHal = !empty($ctk)?0:$Main->PagePerHal;
$LimitHalKIB_D = " limit ".(($HalKIB_D	*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal;
$LimitHalKIB_D = !empty($ctk)?"":$LimitHalKIB_D;
/*
$HalBI = cekPOST("HalBI",1);
$HalKIB_D = cekPOST("HalKIB_D",1);
$LimitHalBI = " limit ".(($HalBI*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal;
$LimitHalKIB_D = " limit ".(($HalKIB_D*1) - 1) * $Main->PagePerHal.",".$Main->PagePerHal;
*/
$cidBI = cekPOST("cidBI");
$cidKIB_D = cekPOST("cidKIB_D");

$cbxDlmRibu = cekPOST("cbxDlmRibu");

$fmTahunPerolehan = cekPOST("fmTahunPerolehan","");
$fmID = cekPOST("fmID",0);
$fmKEPEMILIKAN =  $Main->DEF_KEPEMILIKAN;
$fmWIL = cekPOST("fmWIL");
$fmSKPD = cekPOST("fmSKPD");
$fmUNIT = cekPOST("fmUNIT");
$fmSUBUNIT = cekPOST("fmSUBUNIT");
$fmTAHUNANGGARAN =cekPOST("fmTAHUNANGGARAN",$fmTahunPerolehan);
setWilSKPD();

$Cari = cekPOST("Cari");
$CariBarang = cekGET("CariBarang");
$CariRekening = cekGET("CariRekening");

$fmCariComboIsi = cekPOST("fmCariComboIsi");
$fmCariComboField = cekPOST("fmCariComboField");

$Act = cekPOST("Act");
$Baru = cekPOST("Baru","1");
$Info = "";

//LIST KIB_D
$KondisiD = $fmUNIT == "00" ? "":" and d='$fmUNIT' ";
$KondisiE = $fmSUBUNIT == "00" ? "":" and e='$fmSUBUNIT' ";
$Kondisi = "a1='$fmKEPEMILIKAN' and a='{$Main->Provinsi[0]}' and c='$fmSKPD' $KondisiD $KondisiE ";
//$KondisiTotal = $Kondisi;
if(!empty($fmCariComboIsi) && !empty($fmCariComboField))
{
	$Kondisi .= " and $fmCariComboField like '%$fmCariComboIsi%' ";
}
if(!empty($fmTahunPerolehan))
{
	$Kondisi .= " and thn_perolehan = '$fmTahunPerolehan' ";
}

//$Kondisi.= " and status_barang=1 ";
$Kondisi .=  ' and status_barang <> 3 ';
$KondisiTotal = $Kondisi;


$jmlTotalHarga = mysql_query("select sum(jml_harga) as total  from view_kib_d where $KondisiTotal ");

if($jmlTotalHarga = mysql_fetch_array($jmlTotalHarga))
{
	$jmlTotalHarga = $jmlTotalHarga[0];
}
else
{$jmlTotalHarga=0;}

// copy untuk kode lokasi
//$KODELOKASI = $fmKEPEMILIKAN.".".$fmWIL . "." .$fmSKPD . "." .$fmUNIT . "." . substr($fmTAHUNANGGARAN,2,2) . "." .$fmSUBUNIT;
$KODELOKASI = $fmKEPEMILIKAN.".".$Main->Provinsi[0].".00.".$fmSKPD . "." .$fmUNIT . "."  .$fmSUBUNIT;
// copy untuk kode lokasi sampai disini


$Qry = mysql_query("select * from view_kib_d where $Kondisi order by $Urutkan a1,a,b,c,d,e,f,g,h,i,j,tahun,noreg ");
$jmlDataKIB_D = mysql_num_rows($Qry);
$Qry = mysql_query("select * from view_kib_d where $Kondisi order by $Urutkan a1,a,b,c,d,e,f,g,h,i,j,tahun,noreg  $LimitHalKIB_D");

$no=$Main->PagePerHal * (($HalKIB_D*1) - 1);
$cb=0;
$jmlTampilKIB_D = 0;
$JmlTotalHargaListKIB_D = 0;
$ListBarangKIB_D = "";

PrintSKPD();
PrintTTD();

$ListBarangKIB_D =list_header($SKPD,$UNIT,$SUBUNIT,$WILAYAH,'JAWA BARAT',$KODELOKASI).
list_tableheader($cbxDlmRibu);

if ($jmlDataKIB_D<1) {
$ListBarangKIB_D .= list_table();	
}


$maxrow=1000;
$tmpfile=0;

if ($jmlDataKIB_D>$maxrow) {
$tmpfname = tempnam(sys_get_temp_dir(), 'Tux');	
$handle = fopen($tmpfname, "w+");
fwrite($handle, $ListBarangKIB_D);

$tmpfile=1;
$bufftmp="";
$ListBarangKIB_D = "";

// echo $temp_file;

}


while ($isi = mysql_fetch_array($Qry))
{
	$kota='';
	if (!($isi['alamat_b'] == '' || $isi['alamat_b'] =='00' )){
		$sidBi = 'select nm_wilayah from ref_wilayah where a="'.$isi['alamat_a'].'" and b="'.$isi['alamat_b'].'"'; $cek .= '<br> qrkota='.$sidBi;
		$kota = '<br>'.table_get_value( $sidBi, 'nm_wilayah');
	}
	$Kec = table_get_value('select alamat_kec from kib_d where concat(a1,a,b,c,d,e,f,g,h,i,j,noreg) = "'.
			$isi['a1'].$isi['a'].$isi['b'].$isi['c'].$isi['d'].$isi['e'].$isi['f'].$isi['g'].$isi['h'].$isi['i'].$isi['j'].$isi['noreg'].'"','alamat_kec');
	$Kel = table_get_value('select alamat_kel from kib_d where concat(a1,a,b,c,d,e,f,g,h,i,j,noreg) = "'.
			$isi['a1'].$isi['a'].$isi['b'].$isi['c'].$isi['d'].$isi['e'].$isi['f'].$isi['g'].$isi['h'].$isi['i'].$isi['j'].$isi['noreg'].'"','alamat_kel');
	if($Kec != ''){ $Kec='<br>Kec. '.$Kec;}
	if($Kel != ''){ $Kel='<br>Kel. '.$Kel;}
	
	$jmlTampilKIB_D++;
	$JmlTotalHargaListKIB_D += $isi['jml_harga'];
	$no++;
	$clRow = $no % 2 == 0 ?"row1":"row0";
	
	$tampilHarga = !empty($cbxDlmRibu)? number_format($isi['jml_harga']/1000, 0, ',', '.') : number_format($isi['jml_harga'], 0, ',', '.');

	$tampilHarga = !empty($cbxDlmRibu) ? $isi['jml_harga']/1000: $isi['jml_harga'];

if ($tmpfile==1)
	{

	$bufftmp .= list_table($no,$isi['id_barang'],$isi['noreg'],$isi['nm_barang'],
	$isi['konstruksi'],$isi['panjang'],$isi['lebar'],$isi['luas'],
	ifempty($isi['alamat'],'-').$Kel.$Kec.$kota,
	ifemptyTgl(TglInd($isi['dokumen_tgl']),'-'),
	ifempty($isi['dokumen_no'],'-'),
	ifempty($Main->StatusTanah[$isi['status_tanah']-1][1],'-'),
	ifempty($isi['kode_tanah'],'-'),
	ifempty($Main->AsalUsul[$isi['asal_usul']-1][1],'-'),$tampilHarga,
	ifempty($Main->KondisiBarang[$isi['kondisi_bi']-1][1],'-'),
	ifempty($isi['ket'],'-'));
		
	} else {	
	$ListBarangKIB_D .= list_table($no,$isi['id_barang'],$isi['noreg'],$isi['nm_barang'],
	$isi['konstruksi'],$isi['panjang'],$isi['lebar'],$isi['luas'],
	ifempty($isi['alamat'],'-').$Kel.$Kec.$kota,
	ifemptyTgl(TglInd($isi['dokumen_tgl']),'-'),
	ifempty($isi['dokumen_no'],'-'),
	ifempty($Main->StatusTanah[$isi['status_tanah']-1][1],'-'),
	ifempty($isi['kode_tanah'],'-'),
	ifempty($Main->AsalUsul[$isi['asal_usul']-1][1],'-'),$tampilHarga,
	ifempty($Main->KondisiBarang[$isi['kondisi_bi']-1][1],'-'),
	ifempty($isi['ket'],'-'));
	}
	$cb++;
	if (($cb % $maxrow ==1) & ($cb != 1) & ($tmpfile==1)){
	fwrite($handle, $bufftmp);
	$bufftmp ="";	
	}		
}

$tampilTotalHal =  !empty($cbxDlmRibu)? number_format(($JmlTotalHargaListKIB_D/1000), 0, ',', '.'):number_format(($JmlTotalHargaListKIB_D), 0, ',', '.');
$tampilTotal = !empty($cbxDlmRibu)? number_format(($jmlTotalHarga/1000), 0, ',', '.'): number_format(($jmlTotalHarga), 0, ',', '.');

$tampilHarga = !empty($cbxDlmRibu) ? $JmlTotalHargaListKIB_D/1000: $JmlTotalHargaListKIB_D;

if ($tmpfile==1){
$bufftmp .= listbi_tablefooter($tampilHarga,$cbxDlmRibu).listbi_footer($TITIMANGSA,$JABATANSKPD,$NAMASKPD,$NIPSKPD,$JABATANSKPD1,$NAMASKPD1,$NIPSKPD1);
fwrite($handle, $bufftmp);
fclose($handle);
$sdata = intval(sprintf("%u", filesize($tmpfname)));

// $sdata = filesize($tmpfname);
header('Content-length: $sdata');
if ($sdata < 2 * 1024*1024){
header("Content-Type: application/vnd.ms-excel"); 	
}
header('Content-disposition: attachment; filename="Kartu Inventaris Barang (KIB) D - JALAN IRIGASI DAN JARINGAN.xls"');


// If it's a large file, readfile might not be able to do it in one go, so:
$chunksize = 1 * (1024 * 1024); // how many bytes per chunk
if ($sdata > $chunksize) {
  $handle = fopen($tmpfname, 'rb');
  $bufftmp = '';
  while (!feof($handle)) {
    $bufftmp = fread($handle, $chunksize);
    echo $bufftmp;
    ob_flush();
    flush();
  }
  fclose($handle);
} 
		
} else {
$ListBarangKIB_D  .= list_tablefooter($tampilHarga,$cbxDlmRibu);
//ENDLIST KIB_D


$ArFieldCari = array(
array('nm_barang','Nama Barang'),
array('thn_perolehan','Tahun Pengadaan'),
array('merk','Merek/Type'),
array('ket','Keterangan')
);

$ListBarangKIB_D .= list_footer($TITIMANGSA,$JABATANSKPD,$NAMASKPD,$NIPSKPD,$JABATANSKPD1,$NAMASKPD1,$NIPSKPD1);
$Main->Isi = $ListBarangKIB_D;
$sdata = sizeof($Main->Isi);
    header('Content-length: $sdata');
	header("Content-Type: application/vnd.ms-excel"); 
    header('Content-disposition: attachment; filename="Kartu Inventaris Barang (KIB) D - JALAN IRIGASI DAN JARINGAN.xls"');

}
?>