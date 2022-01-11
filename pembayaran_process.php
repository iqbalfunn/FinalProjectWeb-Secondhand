<?php
session_start();
include "db.php";
if (isset($_SESSION["uid"])) {

	$f_name = $_POST["firstname"];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $negara = $_POST['negara'];
    $kode_pos= $_POST['kode_pos'];
    $cardname= $_POST['cardname'];
    $cardnumber= $_POST['cardNumber'];
    $user_id=$_SESSION["uid"];
    $cardnumberstr=(string)$cardnumber;
    $total_count=$_POST['total_count'];
    $prod_total = $_POST['total_price'];
    
    
    $sql0="SELECT id_pesanan from `data_pesanan`";
    $runquery=mysqli_query($con,$sql0);
    if (mysqli_num_rows($runquery) == 0) {
        echo( mysqli_error($con));
        $id_pesanan=1;
    }else if (mysqli_num_rows($runquery) > 0) {
        $sql2="SELECT MAX(id_pesanan) AS max_val from `data_pesanan`";
        $runquery1=mysqli_query($con,$sql2);
        $row = mysqli_fetch_array($runquery1);
        $id_pesanan= $row["max_val"];
        $id_pesanan=$id_pesanan+1;
        echo( mysqli_error($con));
    }

	$sql = "INSERT INTO `data_pesanan` 
	(`id_pesanan`,`user_id`,`f_name`, `email`,`alamat`, 
	`kota`, `negara`, `kode_pos`, `cardname`,`cardnumber`,`prod_count`,`total_amt`) 
	VALUES ($id_pesanan, '$user_id','$f_name','$email', 
    '$alamat', '$kota', '$negara', '$kode_pos','$cardname','$cardnumberstr','$total_count','$prod_total')";


    if(mysqli_query($con,$sql)){
        $i=1;
        $prod_id_=0;
        $prod_price_=0;
        $prod_qty_=0;
        while($i<=$total_count){
            $str=(string)$i;
            $prod_id_+$str = $_POST['prod_id_'.$i];
            $prod_id=$prod_id_+$str;		
            $prod_price_+$str = $_POST['prod_price_'.$i];
            $prod_price=$prod_price_+$str;
            $prod_qty_+$str = $_POST['prod_qty_'.$i];
            $prod_qty=$prod_qty_+$str;
            $sub_total=(int)$prod_price*(int)$prod_qty;
            $sql1="INSERT INTO `barang_pesanan` 
            (`id_barang_pesanan`,`id_pesanan`,`id_barang`,`kapasitas`,`harga`) 
            VALUES (NULL, '$id_pesanan','$prod_id','$prod_qty','$sub_total')";
            if(mysqli_query($con,$sql1)){
                $del_sql="DELETE from keranjang where user_id=$user_id";
                if(mysqli_query($con,$del_sql)){
                    echo"<script>window.location.href='shop.php'</script>";
                }else{
                    echo(mysqli_error($con));
                }

            }else{
                echo(mysqli_error($con));
            }
            $i++;


        }
    }else{

        echo(mysqli_error($con));
        
    }
    
}else{
    echo"<script>window.location.href='index.php'</script>";
}
	




?>