
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// sambung ke database
define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'Taka');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'secondhandsell');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

//register pengguna
if (isset($_POST['reg_user'])) {
  //menerima semua inpute di value dari from ke form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // validasi formulir
  // add (array_push) kesalahan yang sesuai dengan error aray
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // mengecek database
  // jika pengguna belum terdaftar pada username dan email di database
  $user_check_query = "SELECT * FROM register WHERE Name='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Name'] === $username) {
      array_push($errors, "Username Sudah dibuat");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email Sudah dibuat");
    }
  }

  // register pengguna jika error tidak terjadi diform
  if (count($errors) == 0) {
  	$password = md5($password_1);//mengeskrip password sebelum masuk ke database

  	$query = "INSERT INTO register (Name, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['Name'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM register WHERE email='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>