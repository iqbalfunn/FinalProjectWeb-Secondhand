<?php
#ini adalah halaman formulir Login , jika pengguna sudah login maka tidak akan mengizinkan pengguna untuk mengakses halaman ini dengan menjalankan isset($_SESSION["uid"])
#jika pernyataan di bawah ini mengembalikan true makaakan mengirim pengguna ke halaman profile.php mereka
// di halaman action.php jika pengguna mengklik tombol "Lanjutkan ke pembayaran" saat akan mengirimkan data dalam bentuk dari halaman action.php
if (isset($_POST["login_user_with_barang"])) {
	//produk dengan list array
	$list_barang = $_POST["id_barang"];
	//disini kita mengubah array menjadi format json karena array tidak dapat disimpan di cookie
	$json_e = json_encode($list_barang);
	//disini kita membuat cookie dan nama cookie adalah product_list
	setcookie("list_barang",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>

	<div class="wait overlay">
		<div class="loader"></div>
	</div>
	<div class="container-fluid">
				<!-- row -->
				

					<div class="login-marg">
						
						
								<form onsubmit="return false" id="login" class="login100-form ">
									<div class="billing-details jumbotron">
                                    	<div class="section-title">
											<h2 class="login100-form-title p-b-49" >Login</h2>
                                    	</div>
                                   
                                    
                                    	<div class="form-group">
                                       		<label for="email">Email</label>
                                        	<input class="input input-borders" type="email" name="email" placeholder="Email" id="password" required>
                                    	</div>
                                    
                                    	<div class="form-group">
                                       		<label for="email">Password</label>
                                        	<input class="input input-borders" type="password" name="password" placeholder="password" id="Password" required>
                                    	</div>
                                    
                                    
                                        <input class="primary-btn btn-block"   type="submit"  Value="Login">
                                        
                                        <div class="panel-footer"><div class="alert alert-light"><h4 id="e_msg"></h4></div></div>
                                    
                                	</div>
                                
								</form>
					</div>
			</div>