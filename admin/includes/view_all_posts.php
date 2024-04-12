
<?php 

include ("delete_modal.php");

if(isset($_POST['checkBoxArray'])){

foreach($_POST['checkBoxArray'] as $postValueId){

  $bulk_options = escape($_POST['bulk_options']); 


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


case 'clone':

    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' " ;
                                $select_post_query = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_array($select_post_query)){
                                    $post_title = $row ['post_title'];
                                    $post_category_id = $row ['post_category_id'];
                                    $post_date = $row ['post_date'];
                                    $post_author = $row ['post_author'];
                                    $post_status = $row ['post_status'];
                                    $post_image = $row ['image'];
                                    $post_tags = $row ['post_tags'];
                                    $post_content  = $row ['post_content'];
                                                                    
                                                            
                                 }

                                 $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, image, post_content, post_tags, post_status)";
                                 $query .= "VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$image}','{$post_content}','{$post_tags}', '{$post_status}')";

                                 $copy_query = mysqli_query($connection, $query);

                                 if(!$copy_query){

                                    die("Failed query!");
                                 }

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
                            <option value="clone">Clone</option>



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
                                    <th>User</th>
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
                                    <th>Post views</th>
                                </tr>
                            </thead>
                      
                        <tbody >
                           <?php 
                           
                           
                           global $connection;
                                        $query = "SELECT * FROM posts ORDER BY post_id DESC ";//you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_posts = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_posts)){
                                    $post_id = $row ['post_id'];
                                    $post_author = $row ['post_author'];//takig values from db 
                                    $post_user = $row ['post_user'];
                                    $post_title = $row ['post_title'];
                                    $post_category_id = $row ['post_category_id'];
                                    $post_status = $row ['post_status'];
                                    $post_image = $row ['image'];
                                    $post_tags = $row ['post_tags'];
                                    $post_comment_count = $row ['post_comment_count'];
                                    $post_date = $row ['post_date'];
                                    $post_views_count = $row ['post_views_count'];
                                   

                                     echo "<tr>";

                                     ?>


                                     <td> <input class='checkBoxes' id='selectAllBoxes' type='checkbox'  name='checkBoxArray[]' value='<?php echo $post_id ?>'> </td>;


                                     <?php 



                                     echo "<td> $post_id </td>";



                                     if(!empty($post_author)){
                                        
                                        echo "<td> $post_author </td>";

                                     }elseif(!empty($post_user)) {

                                        echo "<td> $post_user </td>";

                                     }
                                     




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


                                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                    $send_comment_query = mysqli_query($connection, $query);
                                    $row = mysqli_fetch_array($send_comment_query);
                                    $comment_id = $row['comment_id'];
                                    $count_comments = mysqli_num_rows($send_comment_query);
                                     
                                    
                                    
                                    echo "<td> <a href='post_comments.php?id=$post_id'>$count_comments</a></td>";







                                     echo "<td>  $post_date </td>";
                                     echo "<td> <a href='../post.php?p_id={$post_id}'>VIEW POST</a> </td>";
                                     echo "<td> <a href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a> </td>";
                                     echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                                    // echo "<td> <a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>DELETE</a> </td>";
                                     
                                     echo "<td><a href='posts.php?reset={$post_id}'> {$post_views_count} </a> </td>";
                                     echo "</tr>";
                                    }
                           
                           
                           
                           
                           ?>



                               
                           
                        </tbody>
                        </table>
                        </form>

                        <?php  
                        
                        if(isset($_GET['delete'])){
                            $the_post_id = escape($_GET['delete']);
                            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                            $delete_query = mysqli_query($connection, $query);
                            header("Location: posts.php");//this function refresshes page for you, so after pressing delete you dont have to do that because info just disapears correctly

                        }


                            if(isset($_GET['reset'])){
                            $the_post_id = escape( $_GET['reset']);
                            $query = "UPDATE posts set post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . "";
                            $reset_query = mysqli_query($connection, $query);
                            header("Location: posts.php");

                        }
                        
                        
                        ?>



                        <script>

                        $(document).ready(function(){

                            $(".delete_link").on('click', function(){


                              

                                var id = $(this).attr("rel");
                                var delete_url = "posts.php?delete=" + id + "";

                                $(".modal_delete_link").attr("href", delete_url);

                                $("#myModal").modal('show');

                                




                            });


                        });






                        </script>