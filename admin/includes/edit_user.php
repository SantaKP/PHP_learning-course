
<?php 


if(isset($_GET['edit_user'])){

  $the_user_id = escape($_GET['edit_user']);
  $query = "SELECT * FROM users WHERE user_id = $the_user_id";//($the user id donnt need ""because int but have to use double "" not '')you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_users_query = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_users_query)){
                                    $user_id = $row ['user_id'];
                                   $username = $row ['username'];//takig values from db 
                                    $user_password = $row ['user_password'];
                                    $user_firstname = $row ['user_firstname'];
                                    $user_lastname = $row ['user_lastname'];
                                  $user_email = $row ['user_email'];
                                    $user_image = $row ['user_image'];
                                    $user_role = $row ['user_role'];

                                    }












if(isset($_POST['edit_user'])){

//$user_id = $_POST['user_id'];
$user_firstname = escape($_POST['user_firstname']);
$user_lastname = escape($_POST['user_lastname']);
$user_role = escape($_POST['user_role']);

$username =escape( $_POST['username']);
$user_email = escape($_POST['user_email']);
$user_password = escape($_POST['user_password']);
//$post_date = date('d-m-y');




//$query = "INSERT INTO users ( user_firstname, user_lastname, user_role, username, user_email, user_password )";

//$query .= "VALUES ( '{$user_firstname }', '{$user_lastname}', '{$user_role}','{$username}', '{$user_email}', '{$user_password}') ";//now()is function for date 

//$create_user_query = mysqli_query($connection, $query);

//confirmQuery($create_user_query);



//$hashed_password = crypt($user_password, '$2y$10$iusesomecrazystrings02	');


                if(!empty($user_password)){

                    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
                    $get_user_query = mysqli_query($connection, $query_password);
                    confirmQuery($get_user_query);
                    $row = mysqli_fetch_array($get_user_query);


                    $db_user_password = $row['user_password'];

                         if($db_user_password != $user_password){

                        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12 ));

                    }

                                        $query = "UPDATE users SET ";
                                        $query .= "user_firstname = '{$user_firstname}', ";
                                        $query .= "user_lastname = '{$user_lastname}', ";
                                        $query .= "user_role = '{$user_role}', ";
                                        $query .= "username = '{$username}', ";
                                        $query .= "user_email = '{$user_email}', ";
                                        $query .= "user_password = '{$hashed_password}' ";
                                        $query .= "WHERE user_id = '{$the_user_id}' ";


                                        $edit_user_query = mysqli_query($connection, $query);

                                        confirmQuery($edit_user_query);




                        echo "User updated" . "<a href='users.php'>View Users</a>";




                }


                  




}



}else {

header("Location: index.php");





}

?>







<form action="" method="post" enctype="multipart/form-data">




<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" value="<?php echo $user_firstname?>" class="form-control" name="user_firstname">
</div>




<div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" value="<?php echo $user_lastname?>" class="form-control" name="user_lastname">
</div>

<!-- 
here was that option button code what you can find now in edit user under post_title  -->



<div class="form-group">
    <select name="user_role" id=" "> 
    <option value="<?php  echo $user_role; ?>"> <?php  echo $user_role; ?> </option> 
 <?php
if($user_role == 'admin'){
echo "<option value='subscriber'> subscriber  </option>";
}else {
    echo "<option value='admin'> admin  </option>";

}
    ?>





    <!-- <option value="admin"> Admin </option>
    <option value="subscriber"> Subscriber </option> -->
    </select>

</div>






<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" value="<?php echo $username?>"name="username">
</div>



<div class="form-group">
    <label for="post_content">Email</label>
    <textarea class="form-control" type="email" value="<?php echo $user_email ?>"   name="user_email" >
    </textarea>
</div>



<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="user_password">
</div>



<div class="form-group">
   
    <input type="submit" class="btn btn-primary" name="edit_user" value="Edit user">
</div>



</form>
