<?php  
  include "database.php";

  $user_id = $_GET["id"];

  $get_record = mysqli_query($connections, "SELECT * FROM tbl_connection WHERE id='$user_id'");
  $get_record_num = mysqli_num_rows($get_record);

  if($get_record_num > 0) {
     while($row = mysqli_fetch_assoc($get_record)) {
        $user_fname = $row["fname"];
        $user_lname = $row["lname"];
        $user_email = $row["email"];
        $user_position = $row["position"];
        $user_fullname = ucfirst($user_fname) ." ". ucfirst($user_lname[0]);
     }

     //to delete data
     if(isset($_POST["btnDelete"])) {
      mysqli_query($connections, "DELETE FROM tbl_connection WHERE id='$user_id'");
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
        <h1 class="display-4 text-center">DELETE USER</h1>
      </div>
    </div>

    <!-- for deleting data -->
    <form method="POST" style="padding: 0px 200px 0px 200px;">
      <h3>You're about to delete this following info: </h3>
      
      <input class="form-control" type="text" name="del_txtFirstName" value="<?php echo $user_fname; ?>"><br>
      <input class="form-control" type="text" name="del_txtLastName" value="<?php echo $user_lname; ?>"><br>
      <input class="form-control" type="text" name="del_txtEmail" value="<?php echo $user_email; ?>"><br>
      <input class="form-control" type="text" name="del_txtPosition" value="<?php echo $user_position; ?>"><br>

      <h3>Are you sure you want to delete it?</h3>
      <br>
      <input type="submit" name="btnDelete" value="YES, DELETE IT" class="btn btn-primary"><br><br>
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