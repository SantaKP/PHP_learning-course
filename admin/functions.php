<?php   ?>


<?php  //ADDDD CATEGORIES to use header you need to have  ob_start(); function included in your header otherwise it wount work 

function confirmQuery($result){

global $connection;

if(!$result){

    die("QUERY failed ." . mysqli_error($connection));
}

}



function escape($string){

global $connection;



return mysqli_real_escape_string($connection,trim($string));


}







function insert_categories(){
    global $connection;

                                if(isset($_POST['submit'])){
                                  
                                        $cat_title = escape($_POST['cat_title']);
                                        if($cat_title == "" || empty($cat_title)){

                                            echo "field cant be empty";
                                        }else{

                                            $query = "INSERT INTO categories(cat_title)";
                                            $query .= "VALUE('{$cat_title}')";

                                            $create_category_query = mysqli_query($connection,$query);
                                            header("Location: categories.php");//refresh page otherwise it wouldnt delete categorie right away 

                                            if(!$create_category_query){
                                                die("query faied" . mysqli_error($connection));
                                            }
                                        }

                                }
                                
                                }







                                function find_all_categories(){

                                        global $connection;
                                        $query = 'SELECT * FROM categories ';//you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_categories = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_id = $row ['cat_id'];
                                    $cat_title = $row ['cat_title'];//takig values from db 

                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td> ";//displaying values over here 
                                        echo "<td>{$cat_title}</td> ";
                                        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td> ";
                                        echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td> ";
                                        echo "</tr>";

                                    }



                                }


                                function delete_categories(){

                                    global $connection;

                                    if(isset($_GET['delete'])){
                                            $the_cat_id = escape($_GET['delete']);
                                                    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                                    $delete_query = mysqli_query($connection, $query);
                                                    header("Location: categories.php");//refresh page otherwise it wouldnt delete categorie right away 

                                        }
                                        


                                }



                                function users_online(){

                                        if(isset($_GET['onlineusers'])){
                                        global $connection;


                                            if(!$connection){

                                                session_start();
                                                include("../includes/db.php");


                                                  $session = session_id();
                                                $time = time();

                                                $time_out_in_seconds = 05;

                                                $time_out = $time - $time_out_in_seconds;

                                                $query = "SELECT * FROM users_online WHERE session = '$session'";

                                                $send_query = mysqli_query($connection, $query);
                                                $count = mysqli_num_rows($send_query);

                                                if($count == NULL){

                                                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");

                                                }else {

                                                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");



                                                }


                                                $users_online_query =   mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
                                            echo $count_user = mysqli_num_rows($users_online_query);

                                            }// get requests isset()





                                            }

                                  
                                }

                                    users_online();

                                ?>



