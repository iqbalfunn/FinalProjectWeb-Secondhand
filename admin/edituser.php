
    <?php
session_start();
include("../db.php");
$user_id=$_REQUEST['user_id'];

$result=mysqli_query($con,"select user_id,nama_depan,nama_belakang, email, password from data_user where user_id='$user_id'")or die ("query 1 incorrect.......");

list($user_id,$nama_depan,$nama_depan,$email,$user_password)=mysqli_fetch_array($result);

if(isset($_POST['btn_save'])) 
{

$nama_depan=$_POST['nama_depan'];
$nama_belakang=$_POST['nama_belakang'];
$email=$_POST['email'];
$user_password=$_POST['password'];

mysqli_query($con,"update data_user set nama_depan='$nama_depan', nama_belakang='$nama_belakang', email='$email', password='$user_password' where user_id='$user_id'")or die("Query 2 is inncorrect..........");

header("location: manageuser.php");
mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        <div class="col-md-5 mx-auto">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit User</h5>
              </div>
              <form action="edituser.php" name="form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>First name</label>
                        <input type="text" id="nama_depan" name="nama_depan"  class="form-control" value="<?php echo $nama_depan; ?>" >
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>Last name</label>
                        <input type="text" id="nama_belakang" name="nama_belakang" class="form-control" value="<?php echo $nama_belakang; ?>" >
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email"  id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label >Password</label>
                        <input type="text" name="password" id="password" class="form-control" value="<?php echo $user_password; ?>">
                      </div>
                    </div>
                  
                  
                  
                
              </div>
              <div class="card-footer">
                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update</button>
              </div>
              </form>    
            </div>
          </div>
         
          
        </div>
      </div>
      <?php
include "footer.php";
?>