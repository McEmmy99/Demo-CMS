
<?php

if (isset($_POST['create_user'])) {
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];


$query = "INSERT INTO users(user_firstname, user_lastname, username, user_role, user_email, user_password) VALUES ('$user_firstname','$user_lastname','$username','$user_role','$user_email','$user_password')";

$create_post_query = mysqli_query($connection, $query);

confirmQuery($create_post_query);

echo "User Created: " . " " . "<a href='users.php'>View Users</a>";


}

?>





<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="">
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>
	
<!-- 	<div class="form-group">
		<label for="post_category">Post Image</label>
		<input type="file" name="image">
	</div> -->
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="text" class="form-control" name="user_email">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>
</form>