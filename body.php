
<div class="main main-raised">
        <div class="container mainn-raised" style="width:100%;">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="img/secondhand1.jpg" alt="1" style="width:100%;">
      </div>

      <div class="item">
        <img src="img/secondhand2.jpg" alt="2" style="width:100%;">     
      </div>
    
      <div class="item">
        <img src="img/secondhand.jpg" alt="3" style="width:100%;">   
      </div>

      <div class="item">
        <img src="img/secondhand.jpg" alt="4" style="width:100%;">   
      </div>

      <div class="item">
        <img src="img/secondhand.jpg" alt="5" style="width:100%;">     
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only" >Previous</span>
    </a>
    <a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
     	

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Produk Terbaru</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12 mainn mainn-raised">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1" >
									
									<?php
                    include 'db.php';
								
                    
					$product_query = "SELECT * FROM barang,kategori WHERE kategori_barang=cat_id AND id_barang BETWEEN 1 AND 12";
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
				
                        			
										<div class='product'>
										<a href='barang.php?p=$pro_id'><div class='product-img'>
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
							
                        
			";
		}
        ;
      
}
?>
										<!-- product -->
										
	
										<!-- /product -->
										
										
										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title"></h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12 mainn mainn-raised">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										<?php
                    include 'db.php';
								
                    
					$product_query = "SELECT * FROM barang,kategori WHERE kategori_barang=cat_id AND id_barang BETWEEN 59 AND 65";
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
				
                        
                                
								<div class='product'>
									<a href='barang.php?p=$pro_id'><div class='product-img'>
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
                               
							
                        
			";
		}
        ;
      
}
?>
										
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Produk</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/hondacrv1.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan</p>
										<h3 class="product-name"><a href="#">Honda Crv</a></h3>
										<h4 class="product-price">450000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/bmw x1.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan</p>
										<h3 class="product-name"><a href="#">BMW X1</a></h3>
										<h4 class="product-price">500000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/toyotacayla.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan</p>
										<h3 class="product-name"><a href="#">Toyota Cayla</a></h3>
										<h4 class="product-price">120000000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/suzuki xl7.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan</p>
										<h3 class="product-name"><a href="#">SUZUKI XL7</a></h3>
										<h4 class="product-price">200000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/ktm 250 fx.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan/p>
										<h3 class="product-name"><a href="#">KTM 250 FX</a></h3>
										<h4 class="product-price">100000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Exotic 2651.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Kendaraan</p>
										<h3 class="product-name"><a href="#">Exotic 2651</a></h3>
										<h4 class="product-price">1000000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs">
					    
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Produk</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Msi GF63.JPG" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Elektronik</p>
										<h3 class="product-name"><a href="#">Msi GF63</a></h3>
										<h4 class="product-price">10000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/PS 3.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Elektronik</p>
										<h3 class="product-name"><a href="#">PS 3</a></h3>
										<h4 class="product-price">1600000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Samsung Led TV 32 Inch.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Elektronik</p>
										<h3 class="product-name"><a href="#">Samsung LED TV 32 Inch</a></h3>
										<h4 class="product-price">1400000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Nikon D3100.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Elektronik</p>
										<h3 class="product-name"><a href="#">Nikon D3100</a></h3>
										<h4 class="product-price">2200000</h4>
									</div>
								</div>
								<!-- /product widget -->
								

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Lemari.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Rumah Tangga</p>
										<h3 class="product-name"><a href="#">Lemari</a></h3>
										<h4 class="product-price">3200000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Lemari 3 Pintu.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Rumah Tangga</p>
										<h3 class="product-name"><a href="#">Lemari 3 Pintu</a></h3>
										<h4 class="product-price">1200000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Produk</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Rak Tv Kayu.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Rumah Tangga</p>
										<h3 class="product-name"><a href="#">Rak TV Kayu</a></h3>
										<h4 class="product-price">4000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Gitar.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Alat Musik</p>
										<h3 class="product-name"><a href="#">Gitar</a></h3>
										<h4 class="product-price">700000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Biola.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Alat Musik</p>
										<h3 class="product-name"><a href="#">Biola</a></h3>
										<h4 class="product-price">800000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Drum Rolling.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Alat Musik</p>
										<h3 class="product-name"><a href="#">Drum Rolling</a></h3>
										<h4 class="product-price">3500000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Klarinet.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Alat Musik</p>
										<h3 class="product-name"><a href="#">Klarinet</a></h3>
										<h4 class="product-price">2000000</h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="product_images/Aku.jpg" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Buku</p>
										<h3 class="product-name"><a href="#">Aku</a></h3>
										<h4 class="product-price">30000</h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
</div>
		