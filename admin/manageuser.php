
    <?php
session_start();
include("../db.php");
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$user_id=$_GET['user_id'];

/*this is delet quer*/
mysqli_query($con,"delete from data_user where user_id='$user_id'")or header("location: orders.php");
}

include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         <div class="col-md-14">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Pengaturan Pengguna</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table tablesorter table-hover" id="">
                    <thead class=" text-primary">
                      <tr><th>Email</th>
                <th>Password</th>
	<th><a href="adduser.php" class="btn btn-success">Tambahkan Pengguna Baru</a></th>
                    </tr></thead>
                    <tbody>
                      <?php 
                        $result=mysqli_query($con,"select user_id, email, password from data_user")or die ("query 2 incorrect.......");

                        while(list($user_id,$user_name,$user_password)=
                        mysqli_fetch_array($result))
                        {
                        echo "<tr><td>$user_name</td><td>$user_password</td>";

                        echo"<td>
                        <a href='edituser.php?user_id=$user_id' type='button' rel='tooltip' title='' class='btn btn-info' data-original-title='Edit Pengguna'>
                                <i class='material-icons'>Edit</i>
                              <div class='ripple-container'></div></a>
                        <a href='manageuser.php?user_id=$user_id&action=delete' type='button' rel='tooltip' title='' class='btn btn-danger' data-original-title='Hapus Pengguna'>
                                <i class='material-icons'>Hapus</i>
                              <div class='ripple-container'></div></a>
                        </td></tr>";
                        }
                        mysqli_close($con);
                        ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <?php
include "footer.php";
?>