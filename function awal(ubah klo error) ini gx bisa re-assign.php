<?php
class Fungsi
{
	// create
	function ins_regis($nik, $nama, $password, $level, $department, $no_telp, $email, $menu, $tgl_created, $active){
		$query="insert into staff (nik, nama, password, level, email, no_telp, status, tgl_buat, id_dept, id_group)
				values ('$nik', '$nama', '$password', '$level', '$email', '$no_telp', '$active', '$tgl_created', '$department', '$menu')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_dpt($department, $active){
		$query="insert into dept (nama_dept, status_dept)
				values ('$department', '$active')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_log_login($nik, $tgl_masuk){
		$query="insert into log_login (nik, tgl_masuk)
				values ('$nik', '$tgl_masuk')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_group($nama, $status){
		$query="insert into `group` (nama_group, status_group)
				values ('$nama', '$status')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_group_menu($gr, $menu){
		$query="insert into group_menu (id_group, id_menu)
				values ('$gr', '$menu')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_pengumuman($title, $start_date, $end_date, $client, $staff, $konten, $nik){
		$query="insert into pengumuman (judul, konten, tgl_tampil, tgl_tutup, tampil_staff, tampil_client, created_by)
				values ('$title', '$konten', '$start_date', '$end_date', '$staff', '$client', '$nik')";
		$result=mysql_query($query);
		return $result;
	}
	
	function ins_ktgr($ktgr, $sla, $status){
		$query="insert into category (nama_category, sla, status_category)
				values ('$ktgr', '$sla', '$status')";
		$result=mysql_query($query);
		return $result;
	}

	function cr_complaint($ktgr, $attach, $rincian, $nik, $status, $tgl, $notic){
		$query="insert into complaint (id_category, no_ticket, created_by, created_date, rincian_masalah, attachment, status)
				values ('$ktgr', '$notic', '$nik', '$tgl', '$rincian', '$attach', '$status')";
		$result=mysql_query($query);
		return $result;
	}

	function ins_log_complaint($id,$nik,$tgl,$status){
		$query="insert into log_complaint (id_complaint, modified_by, tanggal, status)
				values ('$id', '$nik', '$tgl', '$status')";
		$result=mysql_query($query);
		return $result;
	}
	
	// read
	function get_department($id){
	if($id==0){ $qry_id=" status_dept='0' "; }
	else if ($id==1 or empty($id)){ $qry_id="  status_dept='1' "; }
		$query="select * from dept where $qry_id";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_group($id){
	if($id==0){ $qry_id=" status_group='0' "; }
	else if ($id==1 or empty($id)){ $qry_id="  status_group='1' "; }
		$query="select * from `group` where $qry_id";
		$result=mysql_query($query);
		return $result;
	}
	
	function cek_user($nik,$pass){
		$query="select * from staff where nik='$nik' and password='$pass' && status='1'";
		$result=mysql_query($query);
		return $result;
	}
	
	function fg_pass($nik,$email){
		$query="select * from staff where nik='$nik' and email='$email' && status='1'";
		$result=mysql_query($query);
		return $result;
	}
	
	function cek_email($email){
		$query="select * from staff where email='$email'";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_menu1($id){
		$query="select a.* from menu a inner join group_menu b on a.id=b.id_menu where (tipe='H' or tipe='A') && id_group='$id' order by urut";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_menu2($init,$id){
		$query="select a.* from menu a inner join group_menu b on a.id=b.id_menu where initial='$init' && tipe ='S' 
				&& id_group='$id' order by urut";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_last_login($nik){
		$query="select * from log_login where nik='$nik' order by tgl_masuk desc limit 1";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_staff($status,$job){
		if($job=='SPV' or $job=='Admin'){
			$where= "&& a.level in ('SPV','STAFF')";
		} else {
			$where="";
		}
		$query="SELECT * FROM staff a
				INNER JOIN dept b ON a.id_dept = b.id_dept
				INNER JOIN `group` c ON a.id_group = c.id_group
				LEFT JOIN ( SELECT max( tgl_masuk ) AS last, nik as nik_log FROM log_login GROUP BY nik ) d ON a.nik = d.nik_log
				where status='$status' $where order by tgl_buat desc";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_staff_filter($nik,$nama,$status,$level,$dpt,$menu){
	if(!empty($nik)){ $qry_nik=" and nik='$nik' "; }else{ $qry_nik=""; }
	if(!empty($nama)){ $qry_nama=" and a.nama='$nama' "; }else{ $qry_nama=""; }
	if(!empty($status)){ $qry_status=" and status='$status' "; }else{ $qry_status=""; }
	if(!empty($level)){ $qry_level=" and level='$level' "; }else{ $qry_level=""; }
	if(!empty($dpt)){ $qry_dpt=" and a.id_dept='$dpt' "; }else{ $qry_dpt=""; }
	if(!empty($menu)){ $qry_menu=" and a.id_group='$menu' "; }else{ $qry_menu=""; }
		$query="SELECT * FROM staff a
				INNER JOIN dept b ON a.id_dept = b.id_dept
				INNER JOIN `group` c ON a.id_group = c.id_group
				LEFT JOIN ( SELECT max( tgl_masuk ) AS last, nik as nik_log FROM log_login GROUP BY nik ) d ON a.nik = d.nik_log
				where 1 $qry_nik $qry_nama $qry_status $qry_level $qry_dpt $qry_menu order by tgl_buat desc";
		$result=mysql_query($query);
		return $result;
	}
	
	function staff($id){
		$query="select * from staff where nik='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function dept($id){
		$query="select * from dept where id_dept='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function group($id){
		$query="select * from `group` where id_group='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_group_menu($id){ // fungsi class diagram beda nama field
		$query="select a.*,c.* from `group` a
				inner join group_menu b on a.id_group=b.id_group
				inner join menu c on b.id_menu=c.id where a.id_group='$id' order by urut;";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_dft_menu(){
		$query="select * from menu where urut<>'1000' order by urut;";
		$result=mysql_query($query);
		return $result;
	}
	
	function check_group($nama,$id){
	if(empty($id)){
		$add= "";
	} else {
		$add= " && id_group<>'$id'";
	}
		$query="select * from `group` where nama_group='$nama' $add ;";
		$result=mysql_query($query);
		return $result;
	}
	
	function check_deptn($nama,$id){
	if(empty($id)){
		$add= "";
	} else {
		$add= " && id_dept<>'$id'";
	}
		$query="select * from `dept` where nama_dept='$nama' $add ;";
		$result=mysql_query($query);
		return $result;
	}
	
	
	function get_header_menu($id){
		$query="select a.*,b.id,b.initial,b.title from
				(select initial as init,id as id_sub from menu where id in ($id) or initial='DSB' group by initial) a
				inner join menu b on a.init=b.initial where tipe='H' or initial='DSB'";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_pengumuman_filter($title,$konten,$status,$tampil,$start_date,$end_date){
	$date=date('Y-m-d');
	if(!empty($title)){ $qry_title=" and judul like '%$title%' "; }else{ $qry_title=""; }
	if(!empty($konten)){ $qry_konten=" and konten like '%$konten%' "; }else{ $qry_konten=""; }
	if($status==1){ $qry_status=" "; } elseif ($status==2){ $qry_status=" and (tgl_tampil<='$date' and tgl_tutup>='$date') "; }
	else { $qry_status=" and (tgl_tampil>'$date' or tgl_tutup<'$date')"; }
	if($tampil==1){ $qry_tampil=" and (tampil_client='1' && tampil_staff='1')"; } elseif ($tampil==2){ $qry_tampil=" and tampil_client='1' "; }
	else if($tampil==3) { $qry_tampil=" and tampil_staff='1'";} else { $qry_tampil=" ";}
	if(!empty($start_date)){ $qry_start_date=" and tgl_tampil>='$start_date' "; }else{ $qry_start_date=""; }
	if(!empty($end_date)){ $qry_end_date=" and tgl_tutup<='$end_date' "; }else{ $qry_end_date=""; }
		$query="select b.nama,a.* from pengumuman a
				inner join staff b on a.created_by=b.nik where 1 $qry_title $qry_konten $qry_status $qry_tampil $qry_start_date $qry_end_date";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_pengumuman($status){ // fungsi class diagram beda nama field
	$date=date('Y-m-d');
	if($status==1){ $qry="where (tgl_tampil<='$date' and tgl_tutup>='$date')"; } else { $qry=" where (tgl_tampil>'$date' or tgl_tutup<'$date')"; }
		$query="select b.nama,a.* from pengumuman a
				inner join staff b on a.created_by=b.nik $qry";
		$result=mysql_query($query);
		return $result;
	}
	
	function pengumuman($id){
		$query="select * from pengumuman where id_pengumuman='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_ktgr($id){
	if($id==0){ $qry_id=" status_category='0' "; }
	else if ($id==1 or empty($id)){ $qry_id="  status_category='1' "; }
		$query="select * from `category` where $qry_id";
		$result=mysql_query($query);
		return $result;
	}
	
	function ktgr($id){
		$query="select * from category where id_category='$id'";
		$result=mysql_query($query);
		return $result;
	}

	function check_complaint($tipe,$data){
	if($tipe=="tgl"){
	$where = "created_date='$data'";
	}else if ($tipe=="stat") {
	$where = "status ='Finished' && created_by='$data'";
	}
		$query="select * from complaint where $where";
		$result=mysql_query($query);
		return $result;
	}
	
	function st_complaint($id,$job){
		if ($job=='SPV' or $job=='Admin' or $job=='MGR' ){
			$where = "where (a.status in ('Open','Assignment') or (a.created_by='$id' or a.assigment='$id'))";
		} else {
			$where = "where (a.created_by='$id' or a.assigment='$id')";
		}
		$query="select c.nama,b.nama_category,a.* from complaint a
				inner join category b on a.id_category=b.id_category
				inner join staff c on a.created_by=c.nik $where && a.status<>'Close' order by created_date desc";
		$result=mysql_query($query);
		return $result;
	}
	
	function cl_complaint($id,$job,$startdate,$enddate){
		if($job=='Admin'){
			$where=" 1 ";
		} else {
			$where="(a.created_by='$id' or a.assigment='$id')";
		}
		
		if(!empty($startdate) or !empty($enddate)){
			$where2=" && created_date>='$startdate' && created_date<='$enddate 23:59:59'";
			$limit ="";
		} else {
			$where2="";
			$limit = " limit 20";
		}
		$query="select c.nama,b.nama_category,a.* from complaint a
				inner join category b on a.id_category=b.id_category
				inner join staff c on a.assigment=c.nik where $where && a.status='Close' $where2 order by created_date desc $limit";
		$result=mysql_query($query);
		return $result;
	}
	
	function get_no_ticket($no_ticket){
		$query="select no_ticket from complaint where right(no_ticket,12)='$no_ticket'
				order by created_date desc limit 1;";
		$result=mysql_query($query);
		return $result;
	}
	
	function complaint($id){  // fungsi complaint class diagram beda field ada edit dsni
		$query="select e.nama_dept,c.level,d.nama as nama_assigment,c.nama,b.nama_category,b.sla,a.* from complaint a
				inner join category b on a.id_category=b.id_category
				inner join staff c on a.created_by=c.nik
				left join staff d on a.assigment=d.nik 
				inner join dept e on c.id_dept=e.id_dept where a.id_complaint='$id';";
		$result=mysql_query($query);
		return $result;		
	}
	
	function log_complaint($id){ // fungsi log complaint class diagram beda field
		$query="select b.nama,a.* from log_complaint a
				inner join staff b on a.modified_by = b.nik where id_complaint='$id' order by a.tanggal;";
		$result=mysql_query($query);
		return $result;			
	}
	
	function get_selisih($id){
		$query="select b.* from complaint a
				inner join category b on a.id_category=b.id_category where id_complaint='$id'";
		$result=mysql_query($query);
		return $result;			
	}
	
	function get_lap_complaint($staff,$start_date,$end_date){
		$start="";$end="";
		if(!empty($start_date)){
			$start=" and created_date>='$start_date'";
		}
		if(!empty($end_date)){
			$end=" and created_date<='$end_date 23:59:59'";
		}
		if($staff=="All"){
			$stf="";
		}else{
			$stf=" and assigment='$staff'";
		}
		$query="select e.nama_dept,d.nama as nama_assign, c.nama,b.nama_category,a.* from complaint a
				inner join category b on a.id_category=b.id_category
				inner join staff c on a.created_by=c.nik 
				left join staff d on a.assigment=d.nik 
				inner join dept e on c.id_dept=e.id_dept where 1 $start $end $stf order by created_date desc";
		$result=mysql_query($query);
		return $result;	
	}
	
	function get_lap_dept($start_date,$end_date){
		$month = strtotime($start_date);
		$end = strtotime($end_date);
		$column	="";
		while($month < $end)
		{
			 $column .=" sum(if(left(created_date,7)='".date('Y-m', $month)."' && created_date between '$start_date' and '$end_date',1,0)) as ttl".date('ym', $month).", ";
			 $column .=" sum(if(c.status in ('Close','Finished') && left(created_date,7)='".date('Y-m', $month)."' && created_date between '$start_date' and '$end_date',1,0)) as close".date('ym', $month).", ";
			 $column .=" sum(if(c.status_sla = 'YES' && left(created_date,7)='".date('Y-m', $month)."' && created_date between '$start_date' and '$end_date',1,0)) as sla".date('ym', $month).", ";
			 $month = strtotime("+1 month", $month);
		}
		$query="select $column a.nama_dept,b.nama,a.id_dept,c.no_ticket, sum(if(created_date between '$start_date' and '$end_date',1,0)) as ttl
				from dept a
				left join staff b on a.id_dept=b.id_dept
				left join complaint c on b.nik=c.created_by
				where a.status_dept=1 group by a.nama_dept
				order by sum(if(created_date between '$start_date' and '$end_date',1,0)) desc";
		$result=mysql_query($query);
		return $result;	
	}
	
	function get_lap_pop($type,$data,$dept){
		if($type=="ttl"){
			$where="";
		} else if ($type=="close"){
			$where=" && a.`status` in ('Close','Finished')";
		} else if ($type=="sla") {
			$where=" && a.status_sla='YES'";
		}
		$query="select e.nama_dept,d.nama as nama_assign, c.nama,b.nama_category,a.* from complaint a
				inner join category b on a.id_category=b.id_category
				inner join staff c on a.created_by=c.nik 
				left join staff d on a.assigment=d.nik 
				inner join dept e on c.id_dept=e.id_dept where left(created_date,7)='$data' && e.id_dept='$dept' $where order by created_date desc";
		$result=mysql_query($query);
		return $result;	
	}
	
	function get_sla($startdate,$endate){
		$query="select sum(if(status_sla in ('YES','NO'),1,0)) as ttl, sum(if(status_sla='YES',1,0)) as yes,
			sum(if(status_sla='NO',1,0)) as _no from complaint where created_date between '$startdate' and '$endate';";
		$result=mysql_query($query);
		return $result;	
	}
	
	function get_grafik($start_date,$end_date){
		$query="select count(no_ticket) as ttl,left(created_date,7) as period, sum(if(`status` in ('Close'),1,0)) as cl,
				sum(if(status_sla='YES',1,0)) as sla from complaint where created_date>='$start_date' and created_date <='$end_date'
				group by left(created_date,7)";
		$result=mysql_query($query);
		return $result;	
	}
	
	function status_complaint($level,$id){
	if($level=='Staff'){
	$where=" where assigment='$id'";
	} else if($level=='Client'){
	$where=" where created_by='$id'";
	} else {
	$where="";
	}
		$query="select sum(if(`status`='Open',1,0)) as opened, sum(if(`status`='Assignment',1,0)) as ass,
				sum(if(`status`='Working',1,0)) as wk, sum(if(`status`='Pending',1,0)) as pdn,
				sum(if(`status`='Close',1,0)) as cl, sum(if(`status`='Finished',1,0)) as fs from complaint $where";
		$result=mysql_query($query);
		return $result;	
	}
	
	function status_complaint1(){
		$query="select sum(if(`status`='Open',1,0)) as opened, sum(if(`status`='Assignment',1,0)) as ass,
				sum(if(`status`='Working',1,0)) as wk, sum(if(`status`='Pending',1,0)) as pdn,
				sum(if(`status`='Close',1,0)) as cl from complaint";
		$result=mysql_query($query);
		return $query;	
	}
	
	function get_pengumuman_dsb($lvl,$id){ // fungsi pengumuman class diagram beda field
		if($lvl=='Client'){
			$where=" && tampil_client='1'";
		} else {
			$where=" && tampil_staff='1'";
		}
		
		if(!empty($id)){
			$where2=" && id_pengumuman='$id'";
		} else {
			$where2=" ";
		}
	$date=date('Y-m-d');
		$query="select b.nama,a.* from pengumuman a
				inner join staff b on a.created_by=b.nik where (tgl_tampil<='$date' and tgl_tutup>='$date') $where $where2";
		$result=mysql_query($query);
		return $result;
	}
	
	function _user($nik){
		$query="select * from staff where nik='$nik' && status='1'";
		$result=mysql_query($query);
		return $result;
	}

	function _menu($id){
		$query="select * from `group` a
				inner join group_menu b on a.id_group=b.id_group
				inner join menu c on c.id=b.id_menu where a.id_group='$id'";
		$result=mysql_query($query);
		return $result;
	}
		
	// update
	function upd_logout($nik,$tgl,$tgl_klr){
		$query="update log_login set tgl_keluar='$tgl_klr' where nik='$nik' && tgl_masuk='$tgl'";
		$result=mysql_query($query);
		return $result;
	}

	function upd_staff($nik, $nama, $pass, $level, $dpt, $hp, $email, $menu, $active){
		$query="update staff set nama='$nama', password='$pass', level='$level', email='$email',
				no_telp='$hp', status='$active', id_dept='$dpt', id_group='$menu'  where nik='$nik'";
		$result=mysql_query($query);
		return $result;
	}
	
	function upd_dept($id,$nama,$status){
		$query="update dept set nama_dept='$nama', status_dept='$status' where id_dept='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function upd_group($nama, $status, $id){
		$query="update `group` set nama_group='$nama', status_group='$status' where id_group='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function upd_pengumuman($title, $start_date, $end_date, $client, $staff, $konten, $nik, $id){
		$query="update `pengumuman` set judul='$title', tgl_tampil='$start_date', tgl_tutup='$end_date',
				tampil_client='$client', tampil_staff='$staff', konten='$konten',  created_by='$nik' where id_pengumuman='$id'";
		$result=mysql_query($query);
		return $result;
	}

	function upd_ktgr($id, $ktgr, $sla, $active){
		$query="update category set nama_category='$ktgr', status_category='$active', sla='$sla' where id_category='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function upd_complaint_st($attach, $rincian, $id, $assign, $stat_lama, $status, $solusi, $status_sla, $ktgr){
		if(empty($attach)){
			$qry_attach="";
		}else{
			$qry_attach="attachment='$attach',";
		}
		if(!empty($assign) && $stat_lama=='Open'){
			$qry_assign="assigment='$assign', status='Assignment', ";
		}else{
			$qry_assign="";
		}
		if(!empty($status)){
			$qry_status=" status='$status', ";
		} else {
			$qry_status="";
		}
		if(!empty($solusi)){
			$qry_solusi=" solusi_masalah='$solusi', ";
		} else {
			$qry_solusi="";
		}
		if(!empty($status_sla)){
			$qry_status_sla=" status_sla='$status_sla', ";
		} else {
			$qry_status_sla="";
		}
		if(!empty($ktgr)){
			$qry_ktgr=" id_category='$ktgr', ";
		} else {
			$qry_ktgr="";
		}
		$query="update complaint set $qry_attach $qry_assign $qry_status $qry_solusi $qry_status_sla $qry_ktgr rincian_masalah='$rincian' where id_complaint='$id'";
		$result=mysql_query($query);
		return $result;
	}
	
	function change_pass($id,$pass){
		$query="update staff set `password`='$pass' where nik='$id'";
		$result=mysql_query($query);
		return $result;
	}
		
	// delete
	function del_group_menu($id){
		$query="delete from group_menu where id_group=$id";
		$result=mysql_query($query);
		return $result;
	}
	
	//other
	function moon($date){
		$halfmoon=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mei","06"=>"Jun",
						"07"=>"Jul","08"=>"Agu","09"=>"Sep","10"=>"Okt","11"=>"Nov","12"=>"Des");
		$split=explode("/",$date);
		$result=$split[0]."/".$split[1]."/".$halfmoon[$split[2]]."/".$split[3];
		return $result;		
	}
	
	function fm($date){
		$halfmoon=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"Mei","06"=>"Jun",
						"07"=>"Jul","08"=>"Agu","09"=>"Sep","10"=>"Okt","11"=>"Nov","12"=>"Des");
		$split=explode("-",$date);
		$result=$halfmoon[$split[0]]." ".$split[1];
		return $result;		
	}
}
?>