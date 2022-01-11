<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- 3 meta tag di atas *harus* didahulukan di head; konten dihead lainnya harus datang *setelah* tag ini -->

		<title>SecondHand</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/accountbtn.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
		
    <style>
        #header {
  
            background:#ebf2f2;
            background-color:#ebf2f2;
  
        }
        #footer {
			background:#ebf2f2;
            background-color:#ebf2f2;
        }

        .footer-links li a {
          color: #1E1F29;
        }
        .mainn-raised {
            
            margin: -7px 0px 0px;
            border-radius: 6px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);

        }
       
        .glyphicon{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    }
    .glyphicon-chevron-left:before{
        content:"\f053"
    }
    .glyphicon-chevron-right:before{
        content:"\f054"
    }
        </style>

    </head>

	
	<body>

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
								<font style="font-style:normal; font-size: 33px;color: black;font-family: serif">
                                        SecondHand
                                    </font>
									
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="wrapper">
								<input type="text" class="input" 
								placeholder="Search">
								<div class="searchbtn"><i class="fas fa-search"></i></div>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

								<!-- Cart/Keranjang -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fas fa-shopping-cart" style="font-size:28px;color:black"></i>
										<div class="badge qty">0</div>
									</a>
									<div class="cart-dropdown"  >
										<div class="cart-list" id="cart_product">
										
											
										</div>
										
										<div class="cart-btns">
												<a href="keranjang.php" style="width:100%;"><i class="fa fa-edit"></i>Edit Keranjang</a>
											
										</div>
									</div>
										
									</div>
								<!-- /Cart -->

					<!-- my profile			 -->
					<ul class="header-links pull-right">
						<li><?php
                             include "db.php";
                            if(isset($_SESSION["uid"])){
                                $sql = "SELECT nama_depan FROM data_user WHERE user_id='$_SESSION[uid]'";
                                $query = mysqli_query($con,$sql);
                                $row = mysqli_fetch_array($query);
                                
                                echo '
                               <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><button type="button" class="btn btn-success"></i> Hi '.$row["nama_depan"].'</button></a>
                                  <div class="dropdownn-content">
                                    <a href="logout.php">Log Out</a>
                                    
                                  </div>
                                </div>';

                            }else{ 
                                echo '
                        
                                    <a href="" data-toggle="modal" data-target="#Modal_login"><button type="button" class="btn btn-success">Login</button></a>
                                    <a href="" data-toggle="modal" data-target="#Modal_register"><button type="button" class="btn btn-primary">Register</button></a>
                                    
                                  </div>
                                </div>';
                                
                            }
                            ?>
                               
                        </li>				
					</ul>
					<!-- my profile -->
					
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
		<nav id='navigation'>
			<!-- container -->
           <div class="container" id="get_category_home">
                
            </div>
				<!-- responsive-nav -->
				
			<!-- /container -->
		</nav>
            

		<!-- NAVIGATION -->
		
		<div class="modal fade" id="Modal_login" role="dialog">
                        <div class="modal-dialog">
													
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"></button>
                              
                            </div>
                            <div class="modal-body">
                            <?php
                                include "login_form.php";
    
                            ?>
          
                            </div>
                            
                          </div>
													
                        </div>
                      </div>
                <div class="modal fade" id="Modal_register" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"></button>
                              
                            </div>
                            <div class="modal-body">
                            <?php
                                include "register_form.php";
    
                            ?>
          
                            </div>
                            
                          </div>

                        </div>
                      </div>
		