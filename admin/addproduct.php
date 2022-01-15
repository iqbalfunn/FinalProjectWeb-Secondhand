<?php
session_start();
include("../db.php");


if(isset($_POST['btn_save']))
{
$kategori_barang=$_POST['kategori_barang'];
$nama_barang=$_POST['nama_barang'];
$harga_barang=$_POST['harga_barang'];
$deskripsi_barang=$_POST['deskripsi_barang'];

//picture coding
$picture_name=$_FILES['picture']['name'];
$picture_type=$_FILES['picture']['type'];
$picture_tmp_name=$_FILES['picture']['tmp_name'];
$picture_size=$_FILES['picture']['size'];

if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
{
	if($picture_size<=50000000)
	
		$pic_name=time()."_".$picture_name;
		move_uploaded_file($picture_tmp_name,"../product_images/".$pic_name);
		
mysqli_query($con,"insert into barang (kategori_barang, nama_barang, harga_barang, deskripsi_barang, gambar_barang) values ('$kategori_barang','$nama_barang','$harga_barang','$deskripsi_barang','$pic_name')") or die ("query incorrect");

 header("location: sumit_form.php?success=1");
}

mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
          <div class="row">
          
                
         <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Add Product</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="nama_barang" required name="nama_barang" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="">
                        <label for="">Tambah Gambar</label>
                        <input type="file" name="picture" required class="btn btn-fill btn-success" id="picture" >
                      </div>
                    </div>
                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea rows="4" cols="80" id="deskripsi_barang" required name="deskripsi_barang" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Harga</label>
                        <input type="text" id="harga_barang" name="harga_barang" required class="form-control" >
                      </div>
                    </div>
                  </div>
                 
                  
                
              </div>
              
            </div>
          </div>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Kategori</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kategori Produk</label>
                        <input type="number" id="kategori_barang" name="kategori_barang" required="[1-6]" class="form-control">
                      </div>
                    </div>
                     
                  
                
              </div>
              <div class="card-footer">
                  <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Update Product</button>
              </div>
            </div>
          </div>
          
        </div>
         </form>
          
        </div>
      </div>
      <?php
include "footer.php";
?>