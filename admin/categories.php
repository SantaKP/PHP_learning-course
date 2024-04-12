<?php include "includes/admin_header.php";?>

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



                        <div class="col-xs-6">


                        <?php  insert_categories();
                       
                       
                       
                        ?>




                            <form action ="" method="post"><!-- Add category form    -->

                                <div class="form-group">
                                     <label for = "cat-title">Add category</label>
                                      <input type="text" class= "form-control" name="cat_title">
                                </div>

                                <div class="form-group"> 
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category"> 
                                </div>

                            </form>




                            


                               

<!-- HERE WAS CODE FROM UPDATE_CATEGORIES.PHP  -->

                                <?php //update and include query 
                                
                                if(isset($_GET['edit'])){

                                     $cat_id = escape($_GET['edit']);   

                                     include "includes/update_categories.php";

                                   
                                }
                                
                                
                                
                                
                                
                                
                                ?>








                          </div><!-- Add category form ends here   -->


                        <div class="col-xs-6"> 

                       
                        

                        <!-- table>thead>tr>th*2  can wrhite like this because of plug in  -->
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> Category title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php //find all categories query
                                
                                    find_all_categories();

                                    ?>
                                        <?php /// delete categories 
                                        
                                        delete_categories();
                                        
                                        
                                        ?>
                                
                               
                                
                                </tr>
                            </tbody>
                        </table>
                        </div>





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>