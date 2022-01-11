<?php
session_start();
include "db.php";
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$no_telp = $_POST['no_telp'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
	empty($no_telp) || empty($alamat) || empty($kota)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>$f_name Tidak Valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$l_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>$l_name Ini Tidak Valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>$email Ini Tidak Valid..!</b>
			</div>
		";
		exit();
	}
	if(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Password Lemah</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Password Lemah</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Password Tidak Sama</b>
			</div>
		";
	}
	if(!preg_match($number,$no_telp)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Nomer Telepon $no_telp is not valid</b>
			</div>
		";
		exit();
	}
	if(!(strlen($no_telp) == 12)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Nomer Telepon Harus 12</b>
			</div>
		";
		exit();
	}
	//alamat email yang ada di database kami
	$sql = "SELECT user_id FROM data_user WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
				<b>Email Sudah Terdaftar</b>
			</div>
		";
		exit();
	} else {
		
		$sql = "INSERT INTO `data_user` 
		(`user_id`, `nama_depan`, `nama_belakang`, `email`, 
		`password`, `no_telp`, `alamat`, `kota`) 
		VALUES (NULL, '$f_name', '$l_name', '$email', 
		'$password', '$no_telp', '$alamat', '$kota')";
		$run_query = mysqli_query($con,$sql);
		$_SESSION["uid"] = mysqli_insert_id($con);
		$_SESSION["name"] = $f_name;
		$ip_add = getenv("REMOTE_ADDR");
		$sql = "UPDATE keranjang SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
		if(mysqli_query($con,$sql)){
			echo "register_success";
			echo "<script> location.href='shop.php'; </script>";
            exit;
		}
	}
	}
	
}



?>






















































