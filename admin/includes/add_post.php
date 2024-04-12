
<?php 

if(isset($_POST['create_post'])){

$post_title = escape($_POST['title']);
$post_author =escape( $_POST['author']);
$post_user =escape( $_POST['post_user']);
$post_category_id = escape($_POST['post_category_id']);
$post_status = escape($_POST['post_status']);

$post_image = escape($_FILES['image']['name']);
$post_image_temp = escape($_FILES['image']['tmp_name']);

$post_tags =escape( $_POST['post_tags']);
$post_content = escape($_POST['post_content']);
$post_date = escape(date('d-m-y'));



move_uploaded_file($post_image_temp, "../images/$post_image");
$query = "INSERT INTO posts (post_category_id, post_title, post_user, post_date, image, post_content, post_tags,  post_status)";

$query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_user}', now(), '{$post_image}','{$post_content}', '{$post_tags}', '{$post_status}')";//now()is function for date 
 $create_post_query = mysqli_query($connection, $query);
confirmQuery($create_post_query);

$the_post_id = mysqli_insert_id($connection);//this function is gonna pull out last created id in this table (db with whitch created connection )

echo "<p class='bg-success'>Post created <a href='../post.php?p_id={$the_post_id}'>View post</a> or <a href='posts.php?' > Edit more posts</a></p>";

}





?>







<form action="" method="post" enctype="multipart/form-data">





<div class="form-group">
    <label for="title">Post title</label>
    <input type="text" class="form-control" name="title">
</div>


<div class="form-group">
    <label for="category"> Category</label>
    <select name="post_category_id" id="post_category">

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
    <label for="users"> Users</label>
    <select name="post_user" id="post_category">

<?php 



$query = "SELECT * FROM users  " ;
                                $select_users = mysqli_query($connection, $query);
                                confirmQuery($select_users);
                                
                                    while ($row = mysqli_fetch_assoc($select_users)){
                                    $user_id = $row ['user_id'];
                                    $username = $row ['username'];//takig values from db 
                                    


echo "<option value= '{$username}'>{$username}</option>";

}
?>


    </select>

</div>


<div class="form-group">
    <label for="title">Post author</label>
    <input type="text" class="form-control" name="author">
</div>




<div class="form-group">
   
<select name="post_status" id="">

<option value="draft">Post status</option>
<option value="publish"> publish</option>
<option value="draft">draft</option>

</select>

</div>

<div class="form-group">
    <label for="image">Post image</label>
    <input type="file" name="image">
</div>


<div class="form-group">
    <label for="post_tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>



<div class="form-group">
    <label for="summernote">Post content</label>
    <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
    </textarea>
</div>







<div class="form-group">
   
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
</div>



</form>
