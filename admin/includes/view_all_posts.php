<?php


if (isset($_POST['checkBoxArray'])) {


foreach ($_POST['checkBoxArray'] as $postValueId) {
  
$bulk_options = $_POST['bulk_options'];

switch ($bulk_options) {
  case 'published':
    # code...
  $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $postValueId";
  $update_query = mysqli_query($connection, $query);
    break;

    case 'draft':
    # code...
     $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $postValueId";
  $update_query = mysqli_query($connection, $query);

    break;

    case 'delete':
    # code...
     $query = "DELETE FROM posts WHERE post_id = $postValueId ";
      $delete_query = mysqli_query($connection, $query);
      header("location: ./posts.php");
    break;

       case 'clone':
    # code...
$query = "SELECT * FROM posts WHERE post_id = '$postValueId' ";
$clone_query = mysqli_query ($connection, $query);

while ($row = mysqli_fetch_array($clone_query)) {
  
  $post_title  = $row['post_title'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_status = $row['post_status'];
  $post_category_id = $row['post_category_id'];

}
  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";

$clone_post_query = mysqli_query($connection, $query);

confirmQuery($clone_post_query);


    break;

    case 'reset':
    # code...
  $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $postValueId";
  $reset_query = mysqli_query($connection, $query);
    break;
  
  default:
    # code...
    break;
}

}


}


?>    







<form action="" method="post">


    <table class="table table-bordered table-hover">
<div>
<div id="bulkOptionsContainer" class="col-xs-4">
<select class="form-control" name="bulk_options" id="">
  <option value="">Select Options</option>
  <option value="published">Publish</option>
  <option value="draft">Draft</option>
  <option value="delete">Delete</option>
  <option value="clone">Clone</option>
  <option value="reset">Reset Views</option>
</select>
</div>

<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

</div>
</div>
<br><br>
    	<thead>
    		<tr>
          <th><input type="checkbox" id="selectAllBoxes" name=""></th>
    			<th>Id</th>
    			<th>Author</th>
    			<th>Title</th>
    			<th>Category</th>
    			<th>Status</th>
    			<th>Image</th>
    			<th>Tags</th>
    			<th>Comments</th>
    			<th>Dates</th>
          <th>views</th>
          <th>View Post</th>
          <th>Edit</th>
          <th>Delete</th>
    		</tr>
    	</thead>
    	<tbody>

<?php 
$query = "SELECT * FROM posts ORDER BY post_id DESC";
  	$post_query = mysqli_query($connection, $query);

  	while($row = mysqli_fetch_assoc($post_query)) { 
  		$post_id = $row['post_id'];
  		$post_title  = $row['post_title'];
  		$post_author = $row['post_author'];
  		$post_date = $row['post_date'];
  		$post_image = $row['post_image'];
  		$post_comment_count = $row['post_comment_count'];
  		$post_tags = $row['post_tags'];
  		$post_status = $row['post_status'];
  		$post_category_id = $row['post_category_id'];
      $post_views_count = $row['post_views_count'];

  		echo "<tr>";
      ?>

      <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

      <?php
  		echo"<td>$post_id</td>";
  		echo "<td>$post_author</td>";
  		echo "<td>$post_title</td>";

    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
  $select_categories_id = mysqli_query($connection, $query);
 
  while($row = mysqli_fetch_assoc($select_categories_id)) { 
  $cat_id = $row['cat_id'];
  $cat_title  = $row['cat_title'];


  		echo "<td>{$cat_title}</td>";
    
 }


  		echo "<td>$post_status</td>";
  		echo "<td><img width='90' src='../images/$post_image' alt='image'></td>";
  		echo "<td>$post_tags</td>";

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection, $query);

$row = mysqli_fetch_array($send_comment_query);
$comment_post_id = $row['comment_post_id'];

$count_comments = mysqli_num_rows($send_comment_query);


  		echo "<td><a href='./post_comments.php?id=$post_id'>$count_comments</a></td>";

  		echo "<td>$post_date</td>";
      echo "<td>$post_views_count</td>";
      echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
      echo "<td><a href='./posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
      echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='./posts.php?delete=$post_id'>Delete</a></td>";
  		echo "<tr>";

  	 }
      

       //UPDATE AND INCLUDE QUERY

if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];  

  include "update_post.php";
}




if (isset($_GET['delete'])) {
      $post_id = $_GET['delete'];
      $query = "DELETE FROM posts WHERE post_id = $post_id ";
      $delete_query = mysqli_query($connection, $query);
      header("location: ./posts.php");
    };




?>
    		
	
    	</tbody>
    </table>


  </form>



