<?php  
  include "database.php";

  $user_id = $_GET["id"];

  $get_record = mysqli_query($connections, "SELECT * FROM tbl_connection WHERE id='$user_id'");
  $get_record_num = mysqli_num_rows($get_record);//for checking only

  if($get_record_num > 0) {
     while($row = mysqli_fetch_assoc($get_record)) {
        $user_fname = $row["fname"];
        $user_lname = $row["lname"];
        $user_email = $row["email"];
        $user_position = $row["position"];
     }

  //to set info
  if(isset($_POST["btnUpdate"])) {
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newEmail = $_POST["newEmail"];
    $newPosition = $_POST["newPosition"];

    //to update info
    mysqli_query($connections, "UPDATE tbl_connection SET
      fname='$newFirstName',
      lname='$newLastName',
      email='$newEmail',
      position='$newPosition' 
      WHERE id='$user_id'
    ");
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP CRUD</title>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
		crossorigin="anonymous">
	</head>
	<body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-center">EDIT USER</h1>
      </div>
    </div>

    <!-- for editing values -->
    <form method="POST" style="padding: 0px 200px 0px 200px;">
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"><br>
      <div class="form-group">
				<input class="form-control" type="text" name="newFirstName" value="<?php echo $user_fname; ?>"> 
			</div>
      <div class="form-group">
				<input class="form-control" type="text" name="newLastName" value="<?php echo $user_lname; ?>"> 
			</div>
      <div class="form-group">
				<input class="form-control" type="text" name="newEmail" value="<?php echo $user_email; ?>"> 
			</div>
      <div class="form-group">
        <select class="form-control" name="newPosition">
          <option name="newPosition" value="">Select Position</option>
          <option name="newPosition" <?php if($user_position == "Director") {echo "selected";} ?> value="Director">Director</option>
          <option name="newPosition" <?php if($user_position == "Manager") {echo "selected";} ?> value="Manager">Manager</option>
          <option name="newPosition" <?php if($user_position == "Supervisor") {echo "selected";} ?> value="Supervisor">Supervisor</option>
          <option name="newPosition" <?php if($user_position == "Senior Associate") {echo "selected";} ?> value="Senior Associate">Senior Associate</option>
          <option name="newPosition" <?php if($user_position == "Associate") {echo "selected";} ?> value="Associate">Associate</option>
          <option name="newPosition" <?php if($user_position == "Admin") {echo "selected";} ?> value="Admin">Admin</option>
          <option name="newPosition" <?php if($user_position == "Intern") {echo "selected";} ?> value="Intern">Intern</option>
        </select>
			</div>
      <br>
      <input type="submit" name="btnUpdate" value="Update" class="btn btn-primary"><br><br>
      <a href="index.php">GO BACK TO HOME</a>
    </form>

    <!-- bootstrap scripts-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
		crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
		crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
		crossorigin="anonymous"></script>
	</body>
</html>

<?php
  }else{
    echo "<h1>No record found.</h1>";
    } 
?>