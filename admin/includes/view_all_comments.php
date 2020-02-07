    <table class="table table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Author</th>
    			<th>Comments</th>
    			<th>Email</th>
    			<th>Status</th>
    			<th>In Response To</th>
          <th>Date</th>
    			<th>Approve</th>
    			<th>Unapprove</th>
    			<th>Delete</th>
    		</tr>
</thead>
<tbody>



<?php 


$query = "SELECT * FROM comments ORDER BY comment_id DESC";
  	$comments_query = mysqli_query($connection, $query);


  	while($row = mysqli_fetch_assoc($comments_query)) { 
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

$query = "SELECT * FROM posts WHERE post_id = $comment_post_id";

$title_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($title_query)) {
  $post_title = $row['post_title'];
  $post_id = $row['post_id'];
  echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
}

   		echo "<td>$comment_date</td>";
      echo "<td><a href='comments.php?approved=$comment_id'>Approve</a></td>";
      echo "<td><a href='comments.php?unapproved=$comment_id'>Unapprove</a></td>";
      echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='comments.php?delete=$comment_id'>Delete</a></td>";
  		echo "<tr>";

  	 }
      

       //UPDATE AND INCLUDE QUERY

if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];  

  include "update_post.php";
}


if (isset($_GET['delete'])) {
     $the_comment_id = $_GET['delete'];
      $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
      $delete_query = mysqli_query($connection, $query);
      header("location: ./comments.php");
    }

?>


	
    	</tbody>
    </table>


    <?php 

if (isset($_GET['unapproved'])) {
     $the_comment_id = $_GET['unapproved'];
      $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
      $unapproved_comment_query = mysqli_query($connection, $query);
      header("location: ./comments.php");
    }



    if (isset($_GET['approved'])) {
     $the_comment_id = $_GET['approved'];
      $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
      $approved_comment_query = mysqli_query($connection, $query);
      header("location: ./comments.php");
    }

?>



