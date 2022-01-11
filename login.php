<?php
include "db.php";

session_start();

#skrip login dimulai di sini
#jika kredensial yang diberikan pengguna berhasil cocok dengan data yang tersedia di database, maka akan ke string login_success
#login_success string akan kembali ke fungsi yang disebut $("#login").click()

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = $_POST["password"];
	$sql = "SELECT * FROM data_user WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["nama_depan"];
		$ip_add = getenv("REMOTE_ADDR");
		//membuat cookie di halaman login_form.php jadi jika cookie itu tersedia berarti pengguna tidak login
        
	//jika catatan pengguna tersedia di database maka $count akan sama dengan 1 
	if($count == 1){
		   	
			if (isset($_COOKIE["list_barang"])) {
				$p_list = stripcslashes($_COOKIE["list_barang"]);
				// di sini kita mendekode cookie daftar produk json yang disimpan ke array normal
				$list_barang = json_decode($p_list,true);
				for ($i=0; $i < count($list_barang); $i++) { 
					//setelah mendapatkan user id dari database disini kita akan mengecek user cart item apakah sudah ada produk yang terdaftar atau belum
					$verify_keranjang = "SELECT id FROM keranjang WHERE user_id = $_SESSION[uid] AND p_id = ".$list_barang[$i];
					$result  = mysqli_query($con,$verify_keranjang);
					if(mysqli_num_rows($result) < 1){
						//jika pengguna menambahkan produk pertama kali ke keranjang, kami akan memperbarui user_id ke tabel database dengan id yang valid
						$update_keranjang = "UPDATE keranjang SET user_id = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND user_id = -1";
						mysqli_query($con,$update_keranjang);
					}else{
						//jika produk tersebut sudah tersedia di tabel database maka akan menghapus record tersebut
						$delete_existing_product = "DELETE FROM keranjang WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$list_barang[$i];
						mysqli_query($con,$delete_existing_product);
					}
				}
				// di sini kita destroying cookie pengguna
				setcookie("list_barang","",strtotime("-1 day"),"/");
				 // jika pengguna masuk dari halaman setelah keranjang, kami akan mengirim keranjang_login
				echo "keranjang_login";
				
				
				exit();
				
			}
			//2022 TEST INI YA INI
			echo "login_success";
			// $BackToMyPage = $_SERVER['HTTP_REFERER'];
			// 	if(!isset($BackToMyPage)) {
			// 		header('Location: '.$BackToMyPage);
			// 		echo"<script type='text/javascript'>
					
			// 		</script>";
			// 	} else {
			// 		header('Location: index.php'); // default page
			// 	} 
				
			
            exit;

		}else{
                $email = mysqli_real_escape_string($con,$_POST["email"]);
                $password =md5($_POST["password"]) ;
                $sql = "SELECT * FROM admin_info WHERE admin_email = '$email' AND admin_password = '$password'";
                $run_query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($run_query);

            //jika catatan pengguna tersedia di database maka $count akan sama dengan 1
            if($count == 1){
                $row = mysqli_fetch_array($run_query);
                $_SESSION["uid"] = $row["admin_id"];
                $_SESSION["name"] = $row["admin_name"];
                $ip_add = getenv("REMOTE_ADDR");
                //kami telah membuat cookie di halaman login_form.php jadi jika cookie itu tersedia berarti pengguna tidak login


                    //jika pengguna login dari halaman maka akan mengirimkan login_success
                    echo "login_success";

                    echo "<script> location.href='admin/addproduct.php'; </script>";
                    exit;

                }else{
                    echo "<span style='color:red;'>Password Salah, Atau Belum Teregister..!</span>";
                    exit();
                }
    
	
}
    
	
}

?>