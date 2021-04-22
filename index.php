<?php  
	include "db.inc.php";

	$query = "SELECT * FROM todo";
	$result = mysqli_query($connection,$query);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$todo = $_POST['todo'];
		$date = date('l dS F\, Y');
	if(empty($todo)) {
		$error = "Field is required";
	}	


	else{

		$sql = "INSERT INTO todo(t_name,t_date) VALUES ('$todo','$date');";
		$results = mysqli_query($connection, $sql);

		if (!$results) {
			die("Failed");
		}else{
			header("Location:index.php?todo-added");
		}

	}
	}
	if(isset($_GET['delete_todo'])){
		$dtl_todo = $_GET['delete_todo'];
		$sqli = "DELETE FROM todo WHERE t_id = $dtl_todo";
		$res = mysqli_query($connection,$sqli);

		if (!$res) {
			die("Failed");
		}else{
			header("Location:index.php?todo-deleted");
		}

	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>ToDo Application</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style>
		.todo{
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			border-radius: 3px;
			border: 1px solid #cccccc;
			margin-top: 5px; 
		}
		
		.search{
			margin: 5px;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="todo">
			<h1>ToDo Application</h1>
			<h3>Add a New Todo</h3>
			<?php  
				if(isset($error)){
					echo "<div class = 'alert alert-danger'>$error</div>";
				}


			?>

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method= "POST">
				<div class="form-group">
					<input class="form-control" type="text" name="todo" placeholder="Todo Name">		

				</div>
				<div class="form-group">
					<input class="btn btn-primary" value="Add a New todo Task List" type="submit">

				</div>
				

			</form>
			

		</div>
		<div class="col-lg-4 search">
			<form action="search.php" method="POST">
				<input class="form-control" type="text" name="search" placeholder="Search Todo">
				

			</form>

		</div>
		<div class="table-responsive col-lg-12">
			<table class="table table-bordered table-striped table-hover">
				<thread>
					<th>ID</th>
					<th>Todo</th>
					<th>Date Added</th>
					<th>Edit Todo</th>
					<th>Delete Todo</th>
				</thread>
				<tbody>
					<?php  
						while($row = mysqli_fetch_assoc($result)){
							$t_id = $row["t_id"];
							$t_name = $row['t_name'];
							$t_date = $row['t_date'];
							?>

					<tr>
						<td><?php echo $t_id; ?></td>
						<td><?php echo $t_name; ?></td>
						<td><?php echo $t_date; ?></td>
						<td><a href="edit.php?edit-todo=<?php echo $t_id; ?>" class="btn btn-primary">Edit Todo </a></td>
						<td><a href="index.php?delete_todo=<?php echo $t_id; ?>" class="btn btn-danger">Delete Todo </a></td>
						<td></td>

					</tr>


					<?php  }


					?>



			
				</tbody>	

			</table>	
		</div>
		
	</div>

</body>
</html>