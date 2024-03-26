<?php 

if(isset($_GET['p_id'])){
   $the_post_id = $_GET['p_id'];



}


                                    global $connection;



                                 $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";//you can also limit how many categories you want to display by adding "LIMIT n " 
                                $select_posts_by_id = mysqli_query($connection, $query);
                                
                                    while ($row = mysqli_fetch_assoc($select_posts_by_id)){
                                    $post_id = $row ['post_id'];
                                    $post_author = $row ['post_author'];//takig values from db 
                                    $post_title = $row ['post_title'];
                                    $post_category_id = $row ['post_category_id'];
                                    $post_status = $row ['post_status'];
                                    $post_image = $row ['image'];
                                    $post_tags = $row ['post_tags'];
                                    $post_content = $row ['post_content'];
                                    $post_comment_count = $row ['post_comment_count'];
                                    $post_date = $row ['post_date'];

                                    }

                                    if(isset($_POST['edit_post'])){
                                      
                                    

                                         $post_title = $_POST['title'];
                                         $post_author = $_POST['author'];
                                         $post_category_id = $_POST['post_category_id'];
                                         $post_status = $_POST['post_status'];
                                         $post_image = $_FILES['image']['name'];
                                         $post_image_temp = $_FILES['image']['tmp_name'];
                                         $post_tags = $_POST['post_tags'];
                                       $post_content = $_POST['post_content'];
                                     

                                       move_uploaded_file($post_image_temp, "../images/$post_image");

                                       if(empty($post_image)){
                                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

                                        $select_image = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_array($select_image)){

                                            $post_image = $row['image'];

                                        }




                                       }

                                        $query = "UPDATE posts SET ";
                                        $query .= "post_title = '{$post_title}', ";
                                        $query .= "post_category_id = '{$post_category_id}', ";
                                        $query .= "post_date = now(), ";
                                        $query .= "post_author = '{$post_author}', ";
                                        $query .= "post_status = '{$post_status}', ";
                                        $query .= "post_tags = '{$post_tags}', ";
                                        $query .= "post_content = '{$post_content}', ";
                                        $query .= "image = '{$post_image}' ";
                                        $query .= "WHERE post_id = '{$the_post_id}' ";


                                        $update_post = mysqli_query($connection, $query);
                                       echo "<p class='bg-success'>Post updated <a href='../post.php?p_id={$the_post_id}'>View post</a> or <a href='posts.php?' > Edit more posts</a></p>";

                                    }
?>





<form action="" method="post" enctype="multipart/form-data">





<div class="form-group">
    <label for="title">Post title</label>
    <input  value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>


<div class="form-group">
    <select name="post_category_id" id="post_category_id">

<?php 



$query = "SELECT * FROM categories  " ;
                                $select_categories = mysqli_query($connection, $query);
                                confirmQuery($select_categories);
                                
                                    while ($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_id = $row ['cat_id'];
                                    $cat_title = $row ['cat_title'];//takig values from db 
                                    


echo "<option value= '{$cat_id}'>{$cat_title}</option>";

}
?>


    </select>

</div>

<div class="form-group">
    <label for="title">Post author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
</div>

<div class="form-group">


<select name="post_status" id="">
<option value=' <?php echo $post_status; ?>'> <?php echo $post_status; ?> </option>

<?php 

if($post_status == 'publish'){

echo "<option value= 'publish'>Publish</option>";


}else {

    echo "<option value= 'draft'>draft</option>";




}



?>




</select>
</div>



<div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?> " alt= "">
</div>


<div class="form-group">
    <label for="post_tags">Post tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>



<div class="form-group">
    <label for="summernote">Post content</label>
    <textarea value=""class="form-control" name="post_content" id="summernote" cols="30" rows="10">
    
<?php echo $post_content; ?>

</textarea>
</div>







<div class="form-group">
   
    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
</div>



</form>
