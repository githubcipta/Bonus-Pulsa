# jurnal penyusutan untuk perolehan tanpa history aset
# penyusutan KREDIT (bertambah ) ===========================================================================


# peyusutan mutasi/reklas utk atetap/atb/ekstra
  select '0' as q, 
 '01' as kint, 
 if(aa.f<>'07', '01', '02') as ka,  
 if(aa.f<>'07', aa.f, '04') as kb,  
30 as jns_trans2, 1 as jns_trans3, bb.id as refid, aa.id as refid2, 
aa.Id as idbi, aa.idawal as idawal,
`aa`.`a1` AS `a1`,`aa`.`a` AS `a`,`aa`.`b` AS `b`,`aa`.`c` AS `c`,`aa`.`d` AS `d`,`aa`.`e` AS `e`,`aa`.`e1` AS `e1`,
`aa`.`f` AS `f`,`aa`.`g` AS `g`, aa.h as h, aa.i as i, aa.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,
0 AS `debet`, ifnull(`cc`.`harga`,0) AS `kredit`,
`cc`.`tgl` AS `tgl_buku`,ifnull(`aa`.`harga_atribusi`,0) AS `harga_atribusi`,
`aa`.`asal_usul` AS `asal_usul`,`aa`.`status_barang` AS `status_barang`,`aa`.`staset` AS `staset`,
10 AS `jns_trans` 
from `buku_induk` aa 
join penghapusan bb on aa.id_lama = bb.id_bukuinduk
join penyusutan cc on aa.id = cc.idbi 
where (aa.asal_usul = 4 or aa.asal_usul = 5 ) and aa.id_lama is not null

# - penyusutan aset tetap
union all select 103 as q, '01' as kint, '01' as ka,  bb.f as kb, 
30 as jns_trans2, 8 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`aa`.`harga` AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from  penyusutan aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`  
where bb.f<>'07'  and bb.id_lama is null 

#penyusutan ATB tanpa history aset
union all select 103 as q, '01' as kint, '02' as ka,  '04' as kb, 
30 as jns_trans2, 8 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`aa`.`harga` AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from  penyusutan aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`  
where bb.f='07'  and bb.id_lama is null 

/*
#penyusutan aset tetap
union all select 103 as q, '01' as kint, '01' as ka,  bb.f as kb, 
30 as jns_trans2, 1 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`cc`.`harga` AS `kredit`,
`cc`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from  t_history_aset aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id` 
join penyusutan  cc  on aa.idbi = cc.idbi 
where bb.f<>'07' 
#and (cc.staset is null or cc.staset=0) 
and aa.staset_baru = 3 and bb.id_lama is null  
*/

/*
#penyusutan ATB pakai history aset
union all select 103 as q, 
'01' as kint, '02' as ka, '04' as kb, 
30 as jns_trans2, 1 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`cc`.`harga` AS `kredit`,
`cc`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from t_history_aset aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id` 
join  penyusutan cc  on aa.idbi = cc.idbi
where bb.f='07'  
#and (cc.staset is null or cc.staset=0) 
and (aa.staset_baru = 3 or aa.staset=8) and bb.id_lama is null 
*/

#where 
#((select  sum(div_staset) as staset from t_history_aset where idbi_awal = aa.idbi_awal and tgl<=aa.tgl_pemeliharaan) = 3 or 
#(select  sum(div_staset) as staset from t_history_aset where idbi_awal = aa.idbi_awal and tgl<=aa.tgl_pemeliharaan) = 8 )

/*
# - mutasi 
union all select 103 as q, '01' as kint, '01' as ka,  bb.f as kb, 
30 as jns_trans2, 8 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`aa`.`harga` AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from  penyusutan aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`  
where bb.asal_usul=4 and bb.id_lama<>bb.id
# - reklass
union all select 103 as q, '01' as kint, '01' as ka,  bb.f as kb, 
30 as jns_trans2, 8 as jns_trans3, aa.id as refid, aa.id as refid2, 
bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,0 AS `debet`,`aa`.`harga` AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from  penyusutan aa
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`  
where bb.asal_usul=5 and bb.id_lama<>bb.id
*/

 

# PENYUSUTAN berkurang DEBET =====================================================================================
#penghapusan
union all 
select '104' as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
14 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
 `bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
  bb.f AS `f`, bb.g AS `g`, bb.h as h, bb.i as i, bb.j as j,
 0 AS `jml_barang_d`,0 AS `jml_barang_k`, cc.harga AS `debet`, 0 AS `kredit`,
`aa`.`tgl_penghapusan` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,`aa`.`staset` AS `staset`,
10 AS `jns_trans` 
from `penghapusan` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id`
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_penghapusan
where `aa`.`mutasi` = 0 and (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - mutasi
union all select '105' as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
15 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
 `bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
  bb.f AS `f`, bb.g AS `g`, bb.h as h, bb.i as i, bb.j as j,
 0 AS `jml_barang_d`,0 AS `jml_barang_k`,`cc`.`harga` AS `debet`, 0 AS `kredit`,
`aa`.`tgl_penghapusan` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,`aa`.`staset` AS `staset`,
10 AS `jns_trans` 
from `penghapusan` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id` 
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_penghapusan
where `aa`.`mutasi` = 1 and (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - reklas barang
union all select '106' as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb,  
16 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
 `bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
  bb.f AS `f`, bb.g AS `g`, bb.h as h, bb.i as i, bb.j as j,
 0 AS `jml_barang_d`,0 AS `jml_barang_k`,`cc`.`harga` AS `debet`, 0 AS `kredit`,
`aa`.`tgl_penghapusan` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,`aa`.`staset` AS `staset`,
10 AS `jns_trans` 
from `penghapusan` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id`
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_penghapusan
where `aa`.`mutasi` = 2 and  (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - pemindahtanganan 
union all select 107 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
17 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl_pemindahtanganan` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `pemindahtanganan` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id`
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_pemindahtanganan
where  (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - kemitraan
union all select 108 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
19 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl_pemanfaatan` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `pemanfaatan` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id`
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_pemanfaatan
where  (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - tgr
union all select 108 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb,  
18 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl_gantirugi` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `gantirugi` `aa` 
join `buku_induk` `bb` on `aa`.`id_bukuinduk` = `bb`.`id`
join penyusutan cc on aa.id_bukuinduk = cc.idbi and cc.tgl <= aa.tgl_gantirugi
where  (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10)
# - pindah ke aset lainlain
union all select 109 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb,  
21 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `t_history_aset` `aa` 
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`
join penyusutan cc on aa.idbi = cc.idbi and cc.tgl <= aa.tgl
where (`aa`.`staset` <= 3 or aa.staset = 8 or aa.staset=10) and aa.staset_baru=9
# - pindah  ke extra
union all select 110 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
22 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `t_history_aset` `aa` 
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`
join penyusutan cc on aa.idbi = cc.idbi and cc.tgl <= aa.tgl
where (`aa`.`staset` <> 0 and aa.staset is not null ) and aa.staset_baru=10

# - ekstra pindah  
union all select 110 as q, 
if(aa.staset=3, '01', if(aa.staset=8,'01', if(aa.staset=10,'02','01') )) as kint, 
if(aa.staset=3, '01', if(aa.staset=8,'02', if(aa.staset=10,'00','02') )) as ka, 
if(aa.staset=3, bb.f, if(aa.staset=8,'04', if(aa.staset=10,'00', bb.f) )) as kb, 
22 as jns_trans2, 8 as jns_trans3, aa.id as refid, cc.id as refid2, bb.id as idbi, bb.idawal as idawal,
`bb`.`a1` AS `a1`,`bb`.`a` AS `a`,`bb`.`b` AS `b`,`bb`.`c` AS `c`,`bb`.`d` AS `d`,`bb`.`e` AS `e`,`bb`.`e1` AS `e1`,
`bb`.`f` AS `f`,`bb`.`g` AS `g`, bb.h as h, bb.i as i, bb.j as j,
0 AS `jml_barang_d`,0 AS `jml_barang_k`,cc.harga AS `debet`,0 AS `kredit`,
`aa`.`tgl` AS `tgl_buku`,0 AS `harga_atribusi`,0 AS `asal_usul`,0 AS `status_barang`,0 AS `staset`,
10 AS `jns_trans` 
from `t_history_aset` `aa` 
join `buku_induk` `bb` on `aa`.`idbi` = `bb`.`id`
join penyusutan cc on aa.idbi = cc.idbi and cc.tgl <= aa.tgl
where aa.staset=10



