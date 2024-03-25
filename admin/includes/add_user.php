
<?php 

if(isset($_POST['create_user'])){

//$user_id = $_POST['user_id'];
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];

$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
//$post_date = date('d-m-y');




$query = "INSERT INTO users ( user_firstname, user_lastname, user_role, username, user_email, user_password )";

$query .= "VALUES ( '{$user_firstname }', '{$user_lastname}', '{$user_role}','{$username}', '{$user_email}', '{$user_password}') ";//now()is function for date 

$create_user_query = mysqli_query($connection, $query);

confirmQuery($create_user_query);

echo "User created: " . " " . "<a href='users.php'> View Users</a>";




}





?>







<form action="" method="post" enctype="multipart/form-data">




<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
</div>




<div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
</div>

<!-- 
here was that option button code what you can find now in edit user under post_title  -->



<div class="form-group">
    <select name="user_role" id=" ">
    <option value="subscriber"> Select Options </option>
    <option value="admin"> Admin </option>
    <option value="subscriber"> Subscriber </option>
    </select>

</div>



<!-- 
<div class="form-group">
    <label for="image">Post image</label>
    <input type="file" name="image">
</div> -->


<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="username">
</div>



<div class="form-group">
    <label for="post_content">Email</label>
    <textarea class="form-control" name="user_email" type="email">
    </textarea>
</div>



<div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" class="form-control" name="user_password">
</div>



<div class="form-group">
   
    <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
</div>



</form>
