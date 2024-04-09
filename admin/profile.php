<?php include "includes/admin_header.php";?>


<?php 

if(isset($_SESSION['username'])){

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '{$username}'";

$select_user_profile = mysqli_query($connection, $query);

while($row = mysqli_fetch_array($select_user_profile)){

                                    $user_id = $row ['user_id'];
                                    $username = $row ['username'];//takig values from db 
                                    $user_password = $row ['user_password'];
                                    $user_firstname = $row ['user_firstname'];
                                    $user_lastname = $row ['user_lastname'];
                                    $user_email = $row ['user_email'];
                                    $user_image = $row ['user_image'];
                                    


}

}

?>

<?php 


if(isset($_GET['edit_user'])){

  $the_user_id = $_GET['edit_user'];
  $query = "SELECT * FROM users WHERE user_id = $the_user_id";//($the user id donnt need ""because int but have to use double "" not '')you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_users_query = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_users_query)){
                                    $user_id = $row ['user_id'];
                                  echo  $username = $row ['username'];//takig values from db 
                                    $user_password = $row ['user_password'];
                                    $user_firstname = $row ['user_firstname'];
                                    $user_lastname = $row ['user_lastname'];
                                  $user_email = $row ['user_email'];
                                    $user_image = $row ['user_image'];
                                    

                                    }



}








if(isset($_POST['edit_user'])){

//$user_id = $_POST['user_id'];
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];


$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
//$post_date = date('d-m-y');




//$query = "INSERT INTO users ( user_firstname, user_lastname, user_role, username, user_email, user_password )";

//$query .= "VALUES ( '{$user_firstname }', '{$user_lastname}', '{$user_role}','{$username}', '{$user_email}', '{$user_password}') ";//now()is function for date 

//$create_user_query = mysqli_query($connection, $query);

//confirmQuery($create_user_query);

                                        $query = "UPDATE users SET ";
                                        $query .= "user_firstname = '{$user_firstname}', ";
                                        $query .= "user_lastname = '{$user_lastname}', ";
                                        
                                        $query .= "username = '{$username}', ";
                                        $query .= "user_email = '{$user_email}', ";
                                        $query .= "user_password = '{$user_password}' ";
                                        $query .= "WHERE username= '{$username}' ";


                                        $edit_user_query = mysqli_query($connection, $query);

                                        confirmQuery($edit_user_query);



}





?>






    <div id="wrapper">






        <!-- Navigation -->
      
<?php include "includes/admin_navigation.php";?>









        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                    <h1 class="page-header">
                            Welcome to admin 
                            <small>Author</small>
                        </h1>
                       
                        

                       

                       
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






    <!-- <option value="admin"> Admin </option>
    <option value="subscriber"> Subscriber </option> -->
    </select>

</div>



<!-- 
<div class="form-group">
    <label for="image">Post image</label>
    <input type="file" name="image">
</div> -->


<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" value="<?php echo $username?>"name="username">
</div>



<div class="form-group">
    <label for="post_content">Email</label>
    <textarea class="form-control" type="email" value="<?php echo $user_email ?>"  name="user_email" >
    </textarea>
</div>



<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="user_password">
</div>



<div class="form-group">
   
    <input type="submit" class="btn btn-primary" name="edit_user" value="Update profile">
</div>



</form>






                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>