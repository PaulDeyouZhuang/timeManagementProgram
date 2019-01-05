<?php
	include("configuration.php");

	session_start();
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
	}
	$username=$_SESSION["username"];

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
		<div class="cols">Creation_time</div>
		<div class="cols">
			<input type="datetime-local" name="creation_time" id="creation_time" value="<?php if(isset($row['creation_time'])){echo $row['creation_time'];}?>">
		</div>
	</div>
	<div class="row">
		<div class="cols">Job_type</div>
		<div class="cols">
			<!-- <input type="text" name="job_type" id="job_type" value="<?php if(isset($row['job_type'])){echo $row['job_type'];}?>"> -->

			<?php
				$query_selectJob_type = "SELECT name FROM workspace WHERE user = '".$username."' ORDER BY id";
				$result_select = mysqli_query($link,$query_selectJob_type) or die(mysqli_error()."[".$query_selectJob_type."]");
			?>

				<select type="text" name="job_type" id="job_type" value="<?php if(isset($row['job_type'])){echo $row['job_type'];}?>">
					<?php 
					echo '<option value=""></option>';
					while ($row2 = mysqli_fetch_array($result_select))
					{
                        $selected="";
						if($row2['name']==$row['job_type']){
							$selected="selected";
						}
					    // echo "<option value='".$row2['name']."'\ '".$selected."'>'".$row2['name']."'</option>";
					     echo "<option value='".$row2['name']."' ".$selected.">'".$row2['name']."'</option>";					    
					    // echo "<option value='".$row2['name']."'>'".$row2['name']."'</option>";
					    
					}
					?>        
				</select>



		</div>
	</div>
	<div class="row">
		<div class="cols">Person</div>
		<div class="cols">
			<input type="text" name="person" id="person">
		</div>
	</div>
	<div class="row">
		<div class="cols">Contact</div>
		<div class="cols">
			<input type="text" name="contact" id="contact">
		</div>
	</div>
	<div class="row">
		<div class="cols">Content</div>
		<div class="cols">
			<input type="text" name="content" id="content" value="<?php if(isset($row['content'])){echo $row['content'];}?>">
		</div>
	</div>
		<div class="row">
		<div class="cols">From_project</div>
		<div class="cols">
			<!-- <input type="text" name="from_project" id="from_project"> -->
			<?php
				$query_selectProject = "SELECT name FROM project WHERE user='".$username."' ORDER BY id";
				$result_select = mysqli_query($link,$query_selectProject) or die(mysqli_error()."[".$query_selectProject."]");
			?>

				<select type="text" name="from_project" id="from_project" value="<?php if(isset($row['from_project'])){echo $row['from_project'];}?>">
					<?php 
					echo '<option value=""></option>';
					while ($row2 = mysqli_fetch_array($result_select))
					{
                        $selected="";
						if($row2['name']==$row['from_project']){
							$selected="selected";
						}
					    // echo "<option value='".$row2['name']."'\ '".$selected."'>'".$row2['name']."'</option>";
					     echo "<option value='".$row2['name']."' ".$selected.">'".$row2['name']."'</option>";					    
					    // echo "<option value='".$row2['name']."'>'".$row2['name']."'</option>";
					    
					}
					?>        
				</select>
		</div>
	</div>

	

	<div class="row">
		<div class="cols">
			<input type="submit" name="submit" value="submit">
		</div>
		<!-- <div class="cols">
			<input type="hidden" name="id_in_table" value="<?php if(isset($_GET['id_in_table'])){echo $_GET['id_in_table'];} ?>">
		</div> -->
		<div class="cols">
			<input type="hidden" name="table" value="todo">
		</div>
		<div class="cols">	
			<input type="hidden" name="query_toDelete" value="<?php if(isset($query_toDelete)){echo $query_toDelete;}?>">
		</div>
			<!-- <input type="hidden" name="query_toDelete" value="<?php if(isset($_GET[$query_toDelete])){echo $_GET[$query_toDelete];}?>"> -->

			<!-- <input type="hidden" name="msg_deleteSuccessfully" value="<?php if(isset($_GET[$msg_delete])){echo $_GET[$msg_delete];}?>">			 -->
		</div>

	</div>
</form>
</body>
 <?php
	} 
?>
