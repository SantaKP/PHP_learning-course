
<?php 

if(isset($_POST['checkBoxArray'])){

foreach($_POST['checkBoxArray'] as $postValueId){

  $bulk_options = $_POST['bulk_options']; 


  switch($bulk_options){


 case 'publish';

 $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$postValueId}";

$update_to_publish_status = mysqli_query($connection, $query);

confirmQuery($update_to_publish_status );

break;




case 'draft';

 $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$postValueId}";

$update_to_draft_status = mysqli_query($connection, $query);

confirmQuery($update_to_draft_status );

break;



case 'delete';

 $query = "DELETE  FROM posts  WHERE post_id= {$postValueId}";

$update_to_delete_status = mysqli_query($connection, $query);

confirmQuery($update_to_delete_status );

break;

  }


}

}

?>

<form action="" method="post">

                        <table class= "table table-bordered table-hover">


                            <div id="bulkOptionContainer"  class="col-xs-4">

                            <select  class="form-control" name="bulk_options" id="">

                            <option value="default">select options</option>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>



                            </select>


                            </div>
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="apply">

<a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>





</div>




                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Coments</th>
                                    <th>Date</th>
                                    <th>View post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                      
                        <tbody >
                           <?php 
                           
                           
                           global $connection;
                                        $query = 'SELECT * FROM posts ';//you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_posts = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_posts)){
                                    $post_id = $row ['post_id'];
                                    $post_author = $row ['post_author'];//takig values from db 
                                    $post_title = $row ['post_title'];
                                    $post_category_id = $row ['post_category_id'];
                                    $post_status = $row ['post_status'];
                                    $post_image = $row ['image'];
                                    $post_tags = $row ['post_tags'];
                                    $post_comment_count = $row ['post_comment_count'];
                                    $post_date = $row ['post_date'];
                                   

                                     echo "<tr>";

                                     ?>


                                     <td> <input class='checkBoxes' id='selectAllBoxes' type='checkbox'  name='checkBoxArray[]' value='<?php echo $post_id ?>'> </td>;


                                     <?php 
                                     echo "<td> $post_id </td>";
                                     echo "<td> $post_author </td>";
                                     echo "<td> $post_title </td>";



                                     
                                     
                                     $query = "SELECT * FROM categories WHERE (cat_id) = {$post_category_id}" ;//you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_categories_id = mysqli_query($connection, $query);
                                
                                
                                    while ($row = mysqli_fetch_assoc($select_categories_id)){
                                    $cat_id = $row ['cat_id'];
                                    $cat_title = $row ['cat_title'];//takig values from db 
                                    

                                        
                                     
                                     echo "<td> {$cat_title} </td>";
                                    }








                                     echo "<td> $post_status </td>";
                                     echo "<td> <img width = '100' src= '../images/$post_image' alt ='images'> </td>";
                                     echo "<td> $post_tags  </td>";
                                     echo "<td>  $post_comment_count </td>";
                                     echo "<td>  $post_date </td>";
                                     echo "<td> <a href='../post.php?p_id={$post_id}'>VIEW POST</a> </td>";
                                     echo "<td> <a href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a> </td>";
                                     echo "<td> <a href='posts.php?delete={$post_id}'>DELETE</a> </td>";
                                     echo "</tr>";
                                    }
                           
                           
                           
                           
                           ?>



                               
                           
                        </tbody>
                        </table>
                        </form>

                        <?php  
                        
                        if(isset($_GET['delete'])){
                            $the_post_id = $_GET['delete'];
                            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                            $delete_query = mysqli_query($connection, $query);
                            header("Location: posts.php");//this function refresshes page for you, so after pressing delete you dont have to do that because info just disapears correctly

                        }
                        
                        
                        ?>