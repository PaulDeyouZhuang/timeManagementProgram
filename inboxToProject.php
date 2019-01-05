<?php
	include("configuration.php");
	if(isset($_GET['id_in_table']) && !empty($_GET['id_in_table']) && isset($_GET['table']) && !empty($_GET['table'])){
		$id_in_table=$_GET['id_in_table'];
		$table=$_GET['table'];
		$edit_query="select * from " . $table . " where id='" . $id_in_table . "'";
		$result=mysqli_query($link,$edit_query);
		if (!$result) {
    		printf("Error: %s\n", mysqli_error($link));
    		exit();
		}
		$row=mysqli_fetch_array($result);
		$query_toDelete="DELETE FROM ".$table." where id='".$_GET['id_in_table']."'";	
		// header("Location:index.php?msg=".$query_toDelete);	
		// $query_toDelete="DELETE FROM ".$table." where id='".$_GET['id_in_table']."'";
		$msg_delete="Delete successfully";
		
	}
?>

<?php 
if(isset($_GET['table'])&&$_GET['table']=='inbox'){
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
</head>
<body>
<form action="form_back.php" method="POST">
	<div class="row">
		<div class="cols">Name</div>
		<div class="cols">
			<input type="text" name="project_name" id="project_name" value="<?php if(isset($row['content'])){echo $row['content'];}?>">
			</div>
	</div>
	<div class="row">
		<div class="cols">Goal</div>
		<div class="cols">
			<input type="text" name="project_goal" id="project_goal" >
			</div>
	</div>
	<div class="row">
		<div class="cols">Deadline</div>
		<div class="cols">
			<input type="date" name="project_deadline" id="project_deadline" value="<?php echo '1970-01-01'?>">
			</div>
	</div>


<!-- 	<div class="row">
		<div class="cols">Deadline</div>
		<div class="cols">
			<input type="date" name="project_deadline" id="project_deadline" value="<?php if(isset($row['deadline'])){echo $row['deadline'];} else{echo '1970-01-01';}?>">
			</div>
	</div> -->





	<div class="row">
		<div class="cols">
			<input type="submit" name="submit" value="submit">
		</div>
<!-- 		<div class="cols">
			<input type="hidden" name="id_in_table" value="<?php if(isset($_GET['id_in_table'])){echo $_GET['id_in_table'];} ?>">
		</div> -->
		<div class="cols">
			<input type="hidden" name="table" value="project">
		</div>
		<div class="cols">	
			<input type="hidden" name="query_toDelete" value="<?php if(isset($query_toDelete)){echo $query_toDelete;}?>">
		</div>

	</div>
</form>
</body>

 <?php
	} 
?>
