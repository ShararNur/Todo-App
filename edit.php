<?php  
	include "db.inc.php";

	if(isset($_GET['edit-todo'])){
		$e_id = $_GET['edit-todo'];

	}

	if(isset($_POST['edit_todo'])){
		$edit_todo = $_POST['todo'];

		$query = "UPDATE todo SET t_name = '$edit_todo'WHERE t_id = $e_id";
		$run = mysqli_query($connection,$query);
		
		if(!$run){
			die("Failed");
		}else{
			header("Location: index.php?updated");
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
		


	</style>
</head>
<body>
	<div class="container">
		<div class="todo">
			<h1>ToDo Application</h1>
			<h3>Add a New Todo</h3>
			<form action="" method= "POST">
				<?php
				 	$sql = "SELECT * FROM todo WHERE t_id = $e_id";
				 	$result = mysqli_query($connection,$sql);
				 	$data = mysqli_fetch_array($result);  




				?>




				<div class="form-group">
					<input class="form-control" type="text" name="todo" placeholder="Todo Name" value="<?php echo $data['t_name']; ?>">		

				</div>
				
				 <div class="form-group">
					<input class="btn btn-primary" value="Add a New todo Task List" type="submit" name="edit_todo">

				</div>
				

			</form>
			

		</div>
		
		
	</div>

</body>
</html>