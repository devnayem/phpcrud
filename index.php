<?php
	include "database.php";

	//declare variables
	$txtFirstName = $txtLastName = $txtEmail = $txtPosition = "";	
	$txtFirstNameErr = $txtLastNameErr = $txtEmailErr = $txtPositionErr = "";	
	
	//error message for null values
	if(isset($_POST["btnRegister"])) {
		if(empty($_POST["txtFirstName"])) {
			$txtFirstNameErr = "First Name is Required.";
		}else{
      $txtFirstName = $_POST["txtFirstName"];
		}
		if(empty($_POST["txtLastName"])) {
			$txtLastNameErr = "Last Name is Required.";
		}else{
			$txtLastName = $_POST["txtLastName"];
		}
		if(empty($_POST["txtEmail"])) {
			$txtEmailErr = "Email is Required.";
		}else{
			$txtEmail = $_POST["txtEmail"];
		}
		if(empty($_POST["txtPosition"])) {
			$txtPositionErr = "Position is Required.";
		}else{
			$txtPosition = $_POST["txtPosition"];
		}

		//creating data
		if($txtFirstName && $txtLastName && $txtEmail && $txtPosition) {
			mysqli_query($connections, "INSERT INTO tbl_connection(fname,lname,email,position) VALUES('$txtFirstName','$txtLastName','$txtEmail','$txtPosition')");
			header("Location: index.php");
		}
		
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
        <h1 class="display-4 text-center">PHP CRUD PRACTICE</h1>
      </div>
    </div>
  
    <!-- button trigger -->
    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
      ADD NEW USER
    </button>

    <!-- modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">ADD NEW USER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- register user -->
            <form action="" method="POST">
              <div class="form-group">
                <input class="form-control" type="text" name="txtFirstName" placeholder="First Name" value="<?php echo $txtFirstName; ?>"> 
                <span class="error"><?php echo $txtFirstNameErr; ?></span><br>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="txtLastName" placeholder="Last Name" value="<?php echo $txtLastName; ?>"> 
                <span class="error"><?php echo $txtLastNameErr; ?></span><br>
              </div>
              <div class="form-group">
                <input class="form-control" type="email" name="txtEmail" placeholder="Email" value="<?php echo $txtEmail; ?>"> 
                <span class="error"><?php echo $txtEmailErr; ?></span><br>
              </div>
              <div class="form-group">
                <select class="form-control" name="txtPosition">
                  <option name="txtPosition" value="">Select Position</option>
                  <option name="txtPosition" <?php if($txtPosition == "Director") {echo "selected";} ?> value="Director">Director</option>
                  <option name="txtPosition" <?php if($txtPosition == "Manager") {echo "selected";} ?> value="Manager">Manager</option>
                  <option name="txtPosition" <?php if($txtPosition == "Supervisor") {echo "selected";} ?> value="Supervisor">Supervisor</option>
                  <option name="txtPosition" <?php if($txtPosition == "Senior Associate") {echo "selected";} ?> value="Senior Associate">Senior Associate</option>
                  <option name="txtPosition" <?php if($txtPosition == "Associate") {echo "selected";} ?> value="Associate">Associate</option>
                  <option name="txtPosition" <?php if($txtPosition == "Admin") {echo "selected";} ?> value="Admin">Admin</option>
                  <option name="txtPosition" <?php if($txtPosition == "Intern") {echo "selected";} ?> value="Intern">Intern</option>
                </select>
              <span class="error"><?php echo $txtPositionErr; ?></span><br>
              </div>
              <button type="submit" class="btn btn-primary" name="btnRegister" value="Register">Register</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
            </form>
          </div>
          <div class="modal-footer">
          
          </div>
        </div>
      </div>
    </div>

    <hr>

    <!-- users table -->
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Position</th>
					<th scope="col">Action</th>
				</tr>
      </thead>
      <!-- php tag for viewing user's data-->
			<?php
				$view_query = mysqli_query($connections,"SELECT * FROM tbl_connection");
				while($row = mysqli_fetch_assoc($view_query)) {
					$user_id = $row["id"];
					$user_fname = $row["fname"];
					$user_lname = $row["lname"];
					$user_email = $row["email"];
					$user_position = $row["position"];
          $user_fullname = ucfirst($user_fname) ." ". ucfirst($user_lname);
          
					echo "
						<tr>
							<td>$user_id</td>
							<td>$user_fullname</td>
							<td>$user_email</td>
							<td>$user_position</td>
							<td>
								<a href='edit.php?id=$user_id'>Update</a> |
								<a href='delete.php?id=$user_id'>Delete</a>
							</td>
						</tr>
					";
				}
			?>
		</table>
    
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


    