<?php include "/includes/db.php"; ?>

<?php include "/includes/header.php"; ?>

<?php include "/includes/navigation.php"; ?>






    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

 
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>







                <!-- First Blog Post -->



                               <?php  

                     $query = "SELECT * FROM posts";
                    $select_all_posts_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = substr($row['post_content'], 0,250);
                        $post_tags = $row['post_tags'];
                        $post_image = $row['post_image'];
                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_status = $row['post_status'];

// I still have to make some corrections below regarding the display of published posts or drafts.


                        if ($post_status == 'published') {

                        ?>



                <h2>
                    <h2><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h2>
                </h2>

                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


             <?php }  } ?>

              



            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "/includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->
<div class="row">
    

</div>



        <hr>
    </div>

        <!-- Footer -->
      <?php include "/includes/footer.php"; ?>