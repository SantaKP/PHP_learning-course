<?php   ?>


<?php  //ADDDD CATEGORIES to use header you need to have  ob_start(); function included in your header otherwise it wount work 

function confirmQuery($result){

global $connection;

if(!$result){

    die("QUERY failed ." . mysqli_error($connection));
}

}











function insert_categories(){
    global $connection;

                                if(isset($_POST['submit'])){
                                  
                                        $cat_title = $_POST['cat_title'];
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
                                            $the_cat_id = $_GET['delete'];
                                                    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                                    $delete_query = mysqli_query($connection, $query);
                                                    header("Location: categories.php");//refresh page otherwise it wouldnt delete categorie right away 

                                        }
                                        


                                }
                                ?>



