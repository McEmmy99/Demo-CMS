
<?php

if (isset($_GET['u_id'])) {
	
$the_user_id = $_GET['u_id'];

}

$query = "SELECT * FROM users WHERE user_id = $the_user_id";
  	$select_users_query = mysqli_query($connection, $query);

  	if(!$select_users_query) {
  		die("QUERY FAILED" . mysqli_error($connection));
  	}

  	while($row = mysqli_fetch_assoc($select_users_query)) { 
  		$user_id = $row['user_id'];
  		$username  = $row['username'];
  		$user_password = $row['user_password'];
  		$user_firstname = $row['user_firstname'];
  		$user_lastname = $row['user_lastname'];
  		$user_email = $row['user_email'];
      $user_role = $row['user_role'];


}

if (isset($_POST['edit_user'])) {

$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];


$query = "SELECT randSalt FROM users";
$select_randsalt_query = mysqli_query($connection, $query);
if(!$select_randsalt_query) {
    die("QUERY FAILED!" . mysqli_error($connection));
}

$row = mysqli_fetch_array($select_randsalt_query);
$salt = $row['randSalt'];
$hashed_password = crypt($user_password, $salt);


	$query = "UPDATE users SET ";
	$query .= "user_firstname = '{$user_firstname}', ";
	$query .= "user_lastname = '{$user_lastname}', ";
	$query .= "user_role = '{$user_role}', ";
	$query .= "username = '{$username}', ";
	$query .= "user_email = '{$user_email}', ";
	$query .= "user_password = '{$hashed_password}' ";
	$query .= "WHERE user_id = {$the_user_id}";

	$edit_query = mysqli_query($connection, $query);

	confirmQuery($edit_query);

}


?>





<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="">
			
	<option value='<?php echo $user_role ?>'><?php echo $user_role ?></option>";

<?php

if($user_role == 'Admin') {
	echo "<option value='Subscriber'>Subscriber</option>";	
} else {
	echo "<option value='Admin'>Admin</option>"; }
?>
			
			

		</select>
	</div>
	
<!-- 	<div class="form-group">
		<label for="post_category">Post Image</label>
		<input type="file" name="image">
	</div> -->
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
	</div>
</form>