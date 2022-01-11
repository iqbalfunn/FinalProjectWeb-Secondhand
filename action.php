<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";
if(isset($_POST["page"])){
	$sql = "SELECT * FROM barang";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#product-row' page='$i' id='page' class='active'>$i</a></li>
            
            
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM barang,kategori WHERE kategori_barang=cat_id LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id_barang'];
			$pro_cat   = $row['kategori_barang'];
			$pro_title = $row['nama_barang'];
			$pro_price = $row['harga_barang'];
			$pro_image = $row['gambar_barang'];
            
            $cat_name = $row["cat_title"];
			echo "
				
                        
                        <div class='col-md-3 col-xs-6' >
								<a href='barang.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='barang.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price</h4>
										<div class='product-btns'>
											<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i>Keranjang</button>
									</div>
								</div>
							</div>
                        
			";
		}
	}
}

	if(isset($_POST["addToCart"])){
		

		$p_id = $_POST["proId"];
		

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM keranjang WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
						<b>Barang Sudah Di Simpan..!</b>
				</div>
			";
		} else {
			$sql = "INSERT INTO `keranjang`
			(`p_id`, `ip_add`, `user_id`, `kapasitas`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
						<b>Barnag Di Simpan..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM keranjang WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
							<b>Barang Sudah Ada Di Keranjang, Lanjut..!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `keranjang`
			(`p_id`, `ip_add`, `user_id`, `kapasitas`) 
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
						<b>Barang Sudah Berhasil Di Terima..!</b>
					</div>
				";
				exit();
			}
			
		}
		
		
		
		
	}


//menghitung item keranjang Pengguna 
if (isset($_POST["count_item"])) {
	// Ketika pengguna login maka akan menghitung jumlah item di keranjang dengan menggunakan id session pengguna
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM keranjang WHERE user_id = $_SESSION[uid]";
	}else{
		// Ketika pengguna tidak login maka akan menghitung jumlah item di keranjang dengan menggunakan alamat ip unik pengguna
		$sql = "SELECT COUNT(*) AS count_item FROM keranjang WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Hitung item keranjang Pengguna

//Dapatkan Item Keranjang Dari Database ke Menu Dropdown
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//Ketika pengguna masuk, kueri ini akan dieksekusi
		$sql = "SELECT a.id_barang,a.nama_barang,a.harga_barang,a.deskripsi_barang,a.gambar_barang,b.id,b.kapasitas FROM barang a,keranjang b WHERE a.id_barang=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//Ketika pengguna tidak masuk, kueri ini akan dijalankan
		$sql = "SELECT a.id_barang,a.nama_barang,a.deskripsi_barang,a.harga_barang,a.gambar_barang,b.id,b.kapasitas FROM barang a,keranjang b WHERE a.id_barang=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//tampilkan item keranjang di menu dropdown
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			$total_price=0;
			while ($row=mysqli_fetch_array($query)) {
                
				$n++;
				$id_barang = $row["id_barang"];
				$nama_barang = $row["nama_barang"];
				$harga_barang = $row["harga_barang"];
				$gambar_barang = $row["gambar_barang"];
				$cart_item_id = $row["id"];
				$kapasitas = $row["kapasitas"];
				$total_price=$total_price+$harga_barang;
				echo '
					
                    
                    <div class="product-widget">
												<div class="product-img">
													<img src="product_images/'.$gambar_barang.'" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">'.$nama_barang.'</a></h3>
													<h4 class="product-price"><span class="qty">'.$n.'</span>Rp'.$harga_barang.'</h4>
												</div>
												
											</div>'
                    
                    
                    ;
				
			}
            
            echo '<div class="cart-summary">
				    <small class="qty">'.$n.' Item Dipilih</small>
				    <h5>Rp'.$total_price.'</h5>
				</div>'
            ?>
				
				
			<?php
			
			exit();
		}
	}
	
    
    
    if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//tampilkan item keranjang pengguna dengan tombol "Siap untuk checkout" jika pengguna tidak login
			echo '<div class="main ">
			<div class="table-responsive">
			<form method="post" action="login_form.php">
			
	               <table id="cart" class="table table-hover table-condensed" id="">
    				<thead>
						<tr>
							<th style="width:50%">Produk</th>
							<th style="width:10%">Harga</th>
							<th style="width:8%">Kapasitas</th>
							<th style="width:7%" class="text-center">Harga Total</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    ';
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$id_barang = $row["id_barang"];
					$nama_barang = $row["nama_barang"];
					$harga_barang = $row["harga_barang"];
					$gambar_barang = $row["gambar_barang"];
					$deskripsi_barang = $row["deskripsi_barang"];
					$cart_item_id = $row["id"];
					$kapasitas = $row["kapasitas"];

					echo 
						'  
						<tr>
							<td data-th="Product" >
								<div class="row">
								
									<div class="col-sm-4 "><img src="product_images/'.$gambar_barang.'" style="height: 70px;width:75px;"/>
									<h4 class="nomargin product-name header-cart-item-name"><a href="barang.php?p='.$id_barang.'">'.$nama_barang.'</a></h4>
									</div>
									<div class="col-sm-6">
										<div style="max-width=50px;">
										<p>'.$deskripsi_barang.'</div>
									</div>
									
									
								</div>
							</td>
                            <input type="hidden" name="id_barang[]" value="'.$id_barang.'"/>
				            <input type="hidden" name="" value="'.$cart_item_id.'"/>
							<td data-th="Price"><input type="text" class="form-control price" value="'.$harga_barang.'" readonly="readonly"></td>
							<td data-th="Quantity">
								<input type="text" class="form-control qty" value="'.$kapasitas.'" >
							</td>
							<td data-th="Subtotal" class="text-center"><input type="text" class="form-control total" value="'.$harga_barang.'" readonly="readonly"></td>
							<td class="actions" data-th="">
							<div class="btn-group">
								<a href="#" class="btn btn-info btn-sm update" update_id="'.$id_barang.'"><i class="fa fa-refresh"></i></a>
								
								<a href="#" class="btn btn-danger btn-sm remove" remove_id="'.$id_barang.'"><i class="fa fa-trash-o"></i></a>		
							</div>							
							</td>
						</tr>
					
                            
                            ';
				}
				
				echo '</tbody>
				<tfoot>
					
					<tr>
						<td><a href="shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i>Lanjut Belanja</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><b class="net_total" ></b></td>
						<div id="issessionset"></div>
                        <td>
							
							';
				if (!isset($_SESSION["uid"])) {
					echo '
					
							<a href="" data-toggle="modal" data-target="#Modal_register" class="btn btn-success">Lanjut Ke Pembayaran</a></td>
								</tr>
							</tfoot>
				
							</table></div></div>';
                }else if(isset($_SESSION["uid"])){
					//Pembayaran form
					echo '
					</form>
					
						<form action="pembayaran.php" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart">
							<input type="hidden" name="upload" value="1">';
							  
							$x=0;
							$sql = "SELECT a.id_barang,a.nama_barang,a.harga_barang,a.gambar_barang,b.id,b.kapasitas FROM barang a,keranjang b WHERE a.id_barang=b.p_id AND b.user_id='$_SESSION[uid]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$x++;
								echo  	

									'<input type="hidden" name="total_count" value="'.$x.'">
									<input type="hidden" name="item_name_'.$x.'" value="'.$row["nama_barang"].'">
								  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								     <input type="hidden" name="amount_'.$x.'" value="'.$row["harga_barang"].'">
								     <input type="hidden" name="quantity_'.$x.'" value="'.$row["kapasitas"].'">';
								}
							  
							echo   
								'<input type="hidden" name="return" value="http://localhost/myfiles/public_html/pembayaran_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/myfiles/public_html/pembayaran_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/myfiles/public_html/cancel.php"/>
									<input type="hidden" name="currency_code" value="USD"/>
									<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
									<input type="submit" id="submit" name="login_user_with_product" name="submit" class="btn btn-success" value="Checkout">
									</form></td>
									
									</tr>
									
									</tfoot>
									
							</table></div></div>    
								';
				}
			}
	}
	
	
}

//Menghapus data dikeranjang
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM keranjang WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM keranjang WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
						<b>Barang Di Hapus Di Keranjang</b>
				</div>";
		exit();
	}
}


//Mengupdate data dari keranjang
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$kapasitas = $_POST["kapasitas"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE keranjang SET kapasitas='$kapasitas' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE keranjang SET kapasitas='$kapasitas' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
						<b>Barang Sudah Terupdate</b>
				</div>";
		exit();
	}
}




?>






