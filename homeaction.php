<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if(isset($_POST["categoryhome"])){
	$category_query = "SELECT * FROM kategori WHERE cat_id!=1";
    
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		
            
            
				<!-- responsive-nav -->
				<div id='responsive-nav'>
					<!-- NAV -->
					<ul class='main-nav nav navbar-nav'>
                    	<li><a href='index.php'>Home</a></li>
                    	<li><a href='shop.php'>Kendaraan</a></li>
                    	<li><a href='shop.php'>Elektronik</a></li>
                    	<li><a href='shop.php'>Alat Rumah Tangga</a></li>

	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			$cat_icons = $row["icons"];
            
            $sql = "SELECT COUNT(*) AS count_items FROM barang,kategori WHERE kategori_barang=cat_id";
            $query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($query);
            $count=$row["count_items"];
            
            
            
			echo "
					
                    
                <li class='categoryhome' cid='$cid'><a href='shop.php'>$cat_icons $cat_name</a></li>
                    
			";
		}
        
		echo "
		</ul>
				<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
               
			";
	}
}


if(isset($_POST["gethomeProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
    
	$product_query = "SELECT * FROM barang,kategori WHERE kategori_barang=cat_id AND id_barang BETWEEN 71 AND 74";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
        
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id_barang'];
			$pro_cat   = $row['kategori_barang'];
			$pro_brand = $row['merek_barang'];
			$pro_title = $row['nama_barang'];
			$pro_price = $row['harga_barang'];
			$pro_image = $row['gambar_barang'];
            
            $cat_name = $row["cat_title"];
            
			echo "
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='barang.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='barang.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price</h4>
										<div class='product-btns'>
											<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
											<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
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
        ;
      
}
    
	}
    
if(isset($_POST["get_seleted_Category"]) ||  isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM barang,kategori WHERE kategori_barang = '$id' AND kategori_barang=cat_id";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM barang,kategori WHERE kategori_barang=cat_id AND katakunci_barang LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['id_barang'];
			$pro_cat   = $row['kategori_barang'];
			$pro_brand = $row['merek_barang'];
			$pro_title = $row['nama_barang'];
			$pro_price = $row['harga_barang'];
			$pro_image = $row['gambar_barang'];
            $cat_name = $row["cat_title"];
			echo "
					
                        
                        <div class='col-md-4 col-xs-6'>
								<a href='barang.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img  src='product_images/$pro_image' style='max-height: 170px;' alt=''>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='barang.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price</h4>
										<div class='product-btns'>
											<button class='add-to-wishlist' tabindex='0'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
											<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
											<button class='quick-view' ><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' href='#' tabindex='0' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i>Keranjang</button>
									</div>
								</div>
							</div>
			";
		}
	}?>