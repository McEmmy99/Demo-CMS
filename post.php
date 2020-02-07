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

           if (isset($_GET['p_id'])) {
               $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
            $send_query = mysqli_query($connection, $view_query);
            if(!$send_query) {
                die("QUERY FAILED!" . mysqli_error($connection));
            }

 $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_all_posts_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_image = $row['post_image'];
    $post_title = $row['post_title'];

    ?>



                <h2>
                    <h2><a href=#'><?php echo $post_title; ?></a></h2>
                </h2>

                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <br><br><br><br> 
                <hr>


             <?php  } 
         } else {
            header("location: index.php");
         }


         ?>




                <!-- Blog Comments -->
<?php 

if (isset($_POST['create_comment'])) {
  $the_post_id = $_GET['p_id'];
  $comment_author = $_SESSION['username'];
  $comment_email = $_SESSION['user_email'];
  $comment_content = $_POST['comment_content'];

    if (!empty($comment_content)) {
        # code...
        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())"; 

$comment_query = mysqli_query($connection, $query);

if (!$comment_query) {
    die("QUERY FAILED!" . mysqli_error($connection));
}

// $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
// $update_comment_count = mysqli_query($connection, $query);
// if (!$update_comment_count) {
//     die("QUERY FAILED!" . mysqli_error($connection));
// }

} else {
    echo "<script>alert('Sorry, you can\'t submit an empty comment');</script>";
}

    }




?>

                <!-- Comment -->
<?php
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username']
    # code...?>
   <!-- Comments Form -->
                <div class="well">
                    <h4><?php echo $user . ','; ?> Leave a Comment:</h4>
                    <form action="" method = "post" role="form">

                        <!-- <div class="form-group">
                            <label for="comment_author">Your Name: </label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Your Email: </label>
                            <input type="email" name="comment_email" class="form-control">
                        </div> -->

                        <div class="form-group">
                            <label for="comment_content">Your Comment: </label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

    <?php
} else {
    echo "<h3>You have to be logged in to post a comment</h3>";
}

?>
             

                <!-- Posted Comments -->

<?php

        
        $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ORDER BY comment_id DESC";
        $post_comment_query = mysqli_query($connection, $query);
        if (!$post_comment_query) {
            die("QUERY FAILED!" . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_array($post_comment_query)) {
            $comment_author = $row['comment_author'];
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content']; ?>

  <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

  



                  <?php  }  ?>
                            </div>



            <!-- Blog Sidebar Widgets Column -->
<?php include "/includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>
    </div>

        <!-- Footer -->
      <?php include "/includes/footer.php"; ?>