<?php


if (isset($_POST['checkBoxArray'])) {


foreach ($_POST['checkBoxArray'] as $userValueId) {
  
$bulk_options = $_POST['bulk_options'];

switch ($bulk_options) {
  // case 'published':
  //   # code...
  // $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $userValueId";
  // $update_query = mysqli_query($connection, $query);
  //   break;

  //   case 'draft':
  //   # code...
  //    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $userValueId";
  // $update_query = mysqli_query($connection, $query);

  //   break;

    case 'delete':
    # code...
     $query = "DELETE FROM users WHERE user_id = $userValueId ";
      $delete_query = mysqli_query($connection, $query);
      header("location: ./users.php");


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
  <option value="delete">Delete</option>
</select>
</div>

<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="users.php?source=add_user">Add New</a>

</div>
</div>
<br><br>

    	<thead>
    		<tr>
          <th><input type="checkbox" id="selectAllBoxes" name=""></th>
    			<th>Id</th>
    			<th>Username</th>
    			<th>Firstname</th>
    			<th>Lastname</th>
    			<th>Email</th>
    			<th>Role</th>
    		</tr>
</thead>
<tbody>



<?php 


$query = "SELECT * FROM users";
  	$users_query = mysqli_query($connection, $query);


  	while($row = mysqli_fetch_assoc($users_query)) { 
  		$user_id = $row['user_id'];
  		$username  = $row['username'];
  		$user_password = $row['user_password'];
  		$user_firstname = $row['user_firstname'];
  		$user_lastname = $row['user_lastname'];
  		$user_email = $row['user_email'];
  		$user_image = $row['user_image'];
      $user_role = $row['user_role'];
  		
  		echo "<tr>"; ?>
<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $user_id; ?>'></td>

      <?php
  		echo"<td>$user_id</td>";
  		echo "<td>$username</td>";
      // echo "<td>$user_password</td>";
  		echo "<td>$user_firstname</td>";
  		echo "<td>$user_lastname</td>"; 

// $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";

// $title_query = mysqli_query($connection, $query);

// while ($row = mysqli_fetch_assoc($title_query)) {
//   $post_title = $row['post_title'];
//   $post_id = $row['post_id'];
//   echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
// }

   		echo "<td>$user_email</td>";
      echo "<td>$user_role</td>";
      echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
      echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
      echo "<td><a href='./users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
      echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='users.php?delete=$user_id'>Delete</a></td>";
  		echo "<tr>";

  	 }
      

       //UPDATE AND INCLUDE QUERY

if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];  

  include "update_post.php";
}


if (isset($_GET['delete'])) {
     $the_user_id = $_GET['delete'];
      $query = "DELETE FROM users WHERE user_id = $the_user_id ";
      $delete_query = mysqli_query($connection, $query);
      if (!$delete_query) {
        die("QUERY FAILED!" . mysqli_error($connection));
      }
      header("location: ./users.php");
    }

?>


	
    	</tbody>
    </table>

  </form>


    <?php 

 if (isset($_GET['change_to_sub'])) {
     $the_user_id = $_GET['change_to_sub'];
      $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id";
      $change_to_admin_query = mysqli_query($connection, $query);
      header("location: ./users.php");
    }



    if (isset($_GET['change_to_admin'])) {
     $the_user_id = $_GET['change_to_admin'];
      $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id";
      $change_to_sub_query = mysqli_query($connection, $query);
      header("location: ./users.php");
    }

?>



