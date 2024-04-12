<?php include "db.php"; ?>


<?php 


session_start();








?>





 <?php
 
 if(isset($_POST['login'])){

  $username = escape($_POST['username']);
  $password = escape( $_POST['password']);



$username = mysqli_real_escape_string($connection, $username);//parameters (connection and whatever is needed to be cleaned)
$password = mysqli_real_escape_string($connection, $password);

//after making sure password and username is cleaned we cat put it in db with query 

$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);
 if(!$select_user_query){

    die("Query failed"  . mysqli_error($connection));
 }


while($row = mysqli_fetch_array($select_user_query)){

 $db_id = $row['user_id'];
 $db_username = $row['username'];
 $db_user_password = $row['user_password'];
 $db_user_firstname = $row['user_firstname'];
 $db_user_lastname = $row['user_lastname'];
 $db_user_role = $row['user_role'];

} 

//$password = crypt($password, $db_user_password);//reverses previous password encrryption 

//if($username === $db_username && $password === $db_user_password)// remember!!! == eaqul but if === identical



if(password_verify($password, $db_user_password)){//vertify password take password and compares with db pasword 


$_SESSION['username'] = $db_username;
$_SESSION['firstname'] = $db_user_firstname;
$_SESSION['lastname'] = $db_user_lastname;
$_SESSION['user_role'] = $db_user_role;

 header("Location: ../admin");//Location L is always capital
}
else{

    header("Location: ../index.php");


}


 }
 
 
 
 
 
 
 
 
 
 
 
 ?>