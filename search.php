<?php  
	include "db.inc.php";

	if(isset($_POST['search']))
	{	
		$search = $_POST['search'];
		$query = "SELECT * FROM todo WHERE t_name LIKE '%$search%'";
		$result = mysqli_query($connection,$query);

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
			<h1><a href="index.php">ToDo Application </a> </h1>
			<h3>Add a New Todo</h3>
			
			

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

						if(mysqli_num_rows($result) === 0){

								echo "<tr>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td><h1>No Result Found </h1></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<tr>";
							} 
						else{

							
  
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


					<?php  }}


					?>



			
				</tbody>	

			</table>	
		</div>
		
	</div>

</body>
</html>