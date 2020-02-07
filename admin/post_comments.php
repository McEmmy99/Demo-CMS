<?php include "includes/admin_header.php"?>


<?php ob_start(); ?>



<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
     <h1 class="page-header">
        Welcome, admin
        <small><?php echo $_SESSION['username']; ?></small>
    </h1>


    <table class="table table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Author</th>
    			<th>Comments</th>
    			<th>Email</th>
    			<th>Status</th>
          <th>Date</th>
    		</tr>
</thead>
<tbody>



<?php 

if (isset($_GET['id'])) {
  $post_id = mysqli_real_escape_string($connection, $_GET['id']);
}



$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
  	$comments_query = mysqli_query($connection, $query);


  	while($row = mysqli_fetch_array($comments_query)) { 
  		$comment_id = $row['comment_id'];
  		$comment_post_id  = $row['comment_post_id'];
  		$comment_author = $row['comment_author'];
  		$comment_email = $row['comment_email'];
  		$comment_content = $row['comment_content'];
  		$comment_status = $row['comment_status'];
  		$comment_date = $row['comment_date'];
  		
  		echo "<tr>";
  		echo"<td>$comment_id</td>";
  		echo "<td>$comment_author</td>";
      echo "<td>$comment_content</td>";
  		echo "<td>$comment_email</td>";
  		echo "<td>$comment_status</td>"; 
   		echo "<td>$comment_date</td>";
      echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] ."'>Delete</a></td>";
  		echo "<tr>";

  	 }
      



if (isset($_GET['delete'])) {
     $the_comment_id = $_GET['delete'];
      $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
      $delete_query = mysqli_query($connection, $query);
      header("location: post_comments.php?id=" . $_GET['id'] . "");
    }

?>


	
    	</tbody>
    </table>


</div> 
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>