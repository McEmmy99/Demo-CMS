<?php include "includes/admin_header.php"?>
<?php ob_start(); ?>

<?php

if (isset($_SESSION['username'])) {
	
$the_username = $_SESSION['username'];



$query = "SELECT * FROM users WHERE username = '$the_username'";
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


	$query = "UPDATE users SET ";
	$query .= "user_firstname = '{$user_firstname}', ";
	$query .= "user_lastname = '{$user_lastname}', ";
	$query .= "user_role = '{$user_role}', ";
	$query .= "username = '{$username}', ";
	$query .= "user_email = '{$user_email}', ";
	$query .= "user_password = '{$user_password}' ";
	$query .= "WHERE username = '{$the_username}'";

	$edit_query = mysqli_query($connection, $query);

	confirmQuery($edit_query);

}
}

?>



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
	echo "<option value='subscriber'>Subscriber</option>";	
} else {
	echo "<option value='admin'>Admin</option>"; }
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
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
	</div>
</form>


</div> 
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>