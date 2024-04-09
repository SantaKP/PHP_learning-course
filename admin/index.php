<?php include "includes/admin_header.php";?>

    <div id="wrapper">

//<?php  //if($connection){echo "very good work";}?>



<?php 



?>











        <!-- Navigation -->
      
<?php include "includes/admin_navigation.php";?>









        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Welcome to admin 
                            <small>    <?php echo $_SESSION['username'] ?>  </small>
                        </h1>
                        
                        

                    </div>
                </div>
                <!-- /.row -->

           
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

<?php 

$query = "SELECT * FROM posts";

$select_all_posts = mysqli_query($connection, $query);
$post_count = mysqli_num_rows($select_all_posts);//counts all the rows from $select_all_posts

echo "<div class='huge'>{$post_count}</div> "

?>

                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                   
<?php 

$query = "SELECT * FROM comments";

$select_all_comments = mysqli_query($connection, $query);
$comment_counts = mysqli_num_rows($select_all_comments);//counts all the rows from $select_all_posts

echo "<div class='huge'>{$comment_counts}</div> "

?>


                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">


                    <?php 

$query = "SELECT * FROM users";

$select_all_users = mysqli_query($connection, $query);
$user_counts = mysqli_num_rows($select_all_users);//counts all the rows from $select_all_posts

echo "<div class='huge'>{$user_counts}</div> "

?>

                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 

$query = "SELECT * FROM categories";

$select_all_categories = mysqli_query($connection, $query);
$category_count = mysqli_num_rows($select_all_categories);//counts all the rows from $select_all_posts

echo "<div class='huge'>{$category_count}</div> "

?>

                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->



                <?php 



                $query = "SELECT * FROM posts WHERE post_status = 'publish'";

                 $select_all_published_posts = mysqli_query($connection, $query);
                 $post_published_count = mysqli_num_rows($select_all_published_posts);


                
                $query = "SELECT * FROM posts WHERE post_status = 'draft'";

                $select_all_draft_posts = mysqli_query($connection, $query);
                $post_draft_count = mysqli_num_rows($select_all_draft_posts);//counts all the rows from $select_all_posts

               
               
                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";

                $select_all_unapproved_comments = mysqli_query($connection, $query);
                $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comments);

               
               
                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";

                $select_all_subscribers= mysqli_query($connection, $query);
                $subscriber_count = mysqli_num_rows($select_all_subscribers);

               
               
                
                
                
                
                ?>

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Count'],
           
          <?php  
            
            
            $element_text = ['All Posts', 'Active Posts', 'Draft posts','Coments' ,'Pending comments', 'Users','Subscribers', 'Categories'];
            $element_count = [ $post_count, $post_published_count,  $post_draft_count, $comment_counts, $unapproved_comment_count, $user_counts, $subscriber_count, $category_count];

            for($i = 0; $i < 8; $i++) {

                    echo "['{$element_text[$i]}'" .  ","  .  "{$element_count[$i]}], ";


            }


        
        
        
        ?>


//we used for loop above instead of writing all data staticaly
                //  ['Posts', 5],
                //  ['Users', 8],
                //  ['comments', 9],
                //  ['categories', 5],




 
            ]);



        
         
      

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>