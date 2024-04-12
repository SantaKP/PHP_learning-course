<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


<?php 

// the message
//$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

// send email
//mail("someone@example.com","My subject",$msg);





if(isset($_POST['submit'])){

$to      = "";
$subject = $_POST['subject'];
$body   = $_POST['body'];








}




?>





<?php 

if(isset($_POST['submit'])){

$username =escape($_POST['username']);
$email = escape($_POST['email']);
$password = escape($_POST['password']);


$username = mysqli_real_escape_string($connection, $username);
$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password );


$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12 ));







 
$query = "INSERT INTO users (username, user_email, user_password, user_role) ";
$query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
$register_user_query = mysqli_query($connection, $query);

if(!$register_user_query){

die("query failed!" . mysqli_error($connection) . '' .mysqli_errno($connection));


}$message = "Your registration has been succesful! :)";




}else {

    $message = "Fields cannot be empty! ;(";
} 

//need to fz this part so by default there are no error messages 










?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="enter your email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="email" name="subject" id="subject" class="form-control" placeholder="Enter subject">
                        </div>
                         <div class="form-group">
                            <textarea name="body" id="" class="form-control">  </textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
