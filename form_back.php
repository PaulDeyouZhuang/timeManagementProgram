
<?php
include("configuration.php");
// $current_time=$_POST['current_time'];

	session_start();
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
	}
	$username=$_SESSION["username"];

date_default_timezone_set("Asia/Taipei");
$current_time=date("Y-m-d H:i:s");


$table=$_POST['table'];
if(isset($_POST['query_toDelete'])){
$query_toDelete=$_POST['query_toDelete'];
header("Location:index.php?msg=".$query_toDelete);
$msg_delete="Delete successfully";
// header("Location:index.php?msg="."'There's item.'");
}

// header("Location:index.php?msg=".$query_toDelete);
// header("Location:index.php?msg="."'No item.'");


if(isset($table) && $table=='inbox'){
		$inbox_content=$_POST['inbox_content'];
		if(isset($_POST['inbox_content'])){
			if(empty($_POST['id_in_table'])){
				$query="insert into inbox (`time`,`content`,`user`) values ('".addslashes($current_time)."','".addslashes($inbox_content)."','".addslashes($username)."')";
				$msg="Insert successful";
			} else {
				$query="update inbox set `time`='".addslashes($current_time)."', `content`='".addslashes($inbox_content)."' where `id`='".$_POST['id_in_table']."'";
				$msg="Update successful";
			}
			
			$result=mysqli_query($link,$query);
			if($result){		
				header("Location:index.php?msg=".addslashes($msg)."&table=inbox");				
			} else {
				$msg="Problem with Insert";
				header("Location:index.php?msg=".addslashes($msg)."&table=inbox");
			}
		} else {
			$msg="Please enter the inbox data";
			header("Location:index.php?table=inbox");
		}
	}

elseif(isset($table) && $table=='project'){
		$project_name=$_POST['project_name'];
		$project_goal=$_POST['project_goal'];
		$project_deadline=$_POST['project_deadline'];
		if(isset($_POST['project_name'])){
			if(empty($_POST['id_in_table'])){
				$query="insert into project (`name`,`goal`,`deadline`,`user`) values ('".addslashes($project_name)."','".addslashes($project_goal)."','".addslashes($project_deadline)."','".addslashes($username)."')";
				$msg="Insert successful";
			} else {
				$query="update project set `name`='".addslashes($project_name)."', `goal`='".addslashes($project_goal)."', `deadline`='".addslashes($project_deadline)."' where `id`='".$_POST['id_in_table']."'";
				$msg="Update successful";
			}
			
			$result=mysqli_query($link,$query);
			if($result){
				// header("Location:index.php?msg=".$msg);
				if(isset($query_toDelete)){
					$result_delete=mysqli_query($link,$query_toDelete);
					if($result_delete){
						header("Location:index.php?msg=".addslashes($msg)."&msg2=".addslashes($msg_delete)."&table=project");
					}
					else{
						$msg_toDelete="Delete Unsuccessfully.";
						header("Location:index.php?msg=".addslashes($msg)."&msg2=".addslashes($msg_delete)."&table=project");
					}
				}
				else{
					header("Location:index.php?msg=".addslashes($msg)."&table=project");
				}
			} else {
				$msg="Problem with Insert";
				header("Location:index.php?msg=".addslashes($msg)."&table=project");
			}
		} else {
			$msg="Please enter the project data";
			header("Location:index.php?table=project");
		}
	}

	elseif(isset($table) && $table=='todo'){
		// header("Location:index.php?msg2=".$query_toDelete);
		// $todo_creation_time=$_POST['creation_time'];
		$todo_job_type=$_POST['job_type'];
		$todo_content=$_POST['content'];
		$todo_person=$_POST['person'];
		$todo_contact=$_POST['contact'];
		$todo_from_project=$_POST['from_project'];
		if(isset($_POST['job_type']) && isset($_POST['content'])){
			if(empty($_POST['id_in_table'])){
				$query="insert into todo (`creation_time`,`job_type`,`content`,`person`,`contact`,`from_project`,`user`) values ('".addslashes($current_time)."','".addslashes($todo_job_type)."','".addslashes($todo_content)."','".addslashes($todo_person)."','".addslashes($todo_contact)."','".addslashes($todo_from_project)."','".addslashes($username)."')";
				$msg="Insert successful";
			} else {
				$query="update todo set `creation_time`='".addslashes($current_time)."', `job_type`='".addslashes($todo_job_type)."', `content`='".addslashes($todo_content)."', `person`='".addslashes($todo_person)."', `contact`='".addslashes($todo_contact)."', `from_project`='".addslashes($todo_from_project)."' where `id`='".$_POST['id_in_table']."'";
				$msg="Update successful";
			}
			
			$result=mysqli_query($link,$query);
			if($result){
				// header("Location:index.php?msg=".addslashes($msg)."&msg2=".$query_toDelete);
				if(isset($query_toDelete)){
					$result_delete=mysqli_query($link,$query_toDelete);
					if($result_delete){
						header("Location:index.php?msg=".addslashes($msg)."&msg2=".addslashes($msg_delete)."&table=todo");
					}
					else{
						$msg_toDelete="Delete Unsuccessfully.";
						header("Location:index.php?msg=".addslashes($msg)."&msg2=".addslashes($msg_delete)."&table=todo");
					}

				// 	// $result_delete=mysqli_query($link,$query_toDelete) or die(mysqli_error($link,$query_toDelete));
				// 	// $result_delete=mysqli_query($link,$query_toDelete);
				// 	// if($result_delete){
				// 	// header("Location:index.php?msg=".$msg_delete);
				// 	// }
				// 	// else{
				// 	// $msg_delete="Problem with Delete";
				// 	// header("Location:index.php?msg=".$msg_delete);
				// 	// }
				// 	if(!mysqli_query($link,$query_toDelete)){
				// // 		// echo("Error description: " . mysqli_error($link));
				// 		header("Location:index.php?msg2=".$query_toDelete);
				// 	}

				}
				else{
					header("Location:index.php?msg=".addslashes($msg)."&table=todo");	
				}
			} else {
				$msg="Problem with Insert";
				header("Location:index.php?msg=".addslashes($msg)."&table=todo");
			}
		} else {
			$msg="Please enter the todo data";
			header("Location:index.php?msg=".addslashes($msg)."&table=todo");
		}
	}

	elseif(isset($table) && $table=='future'){
		$future_name=$_POST['future_name'];
		if(isset($_POST['future_name'])){
			if(empty($_POST['id_in_table'])){
				$query="insert into future (`name`, `user`) values ('".addslashes($future_name)."','".addslashes($username)."')";
				$msg="Insert successful";
			} else {
				$query="update future set `name`='".addslashes($future_name)."' where `id`='".$_POST['id_in_table']."'";
				$msg="Update successful";
			}
			
			$result=mysqli_query($link,$query);
			if($result){
				header("Location:index.php?msg=".addslashes($msg)."&table=future");
			} else {
				$msg="Problem with Insert";
				header("Location:index.php?msg=".addslashes($msg)."&table=future");
			}
		} else {
			$msg="Please enter the future data";
			header("Location:index.php?table=future");
		}
	}

elseif(isset($table) && $table=='workspace'){
		$job_type=$_POST['job_type'];
		if(isset($_POST['job_type'])){
			if(empty($_POST['id_in_table'])){
				$query="insert into workspace (`name`, `user`) values ('".addslashes($job_type)."','".addslashes($username)."')";
				$msg="Insert successful";
			} else {
				$query="update workspace set `name`='".addslashes($job_type)."' where `id`='".$_POST['id_in_table']."'";
				$msg="Update successful";
			}
			
			$result=mysqli_query($link,$query);
			if($result){		
				header("Location:index.php?msg=".addslashes($msg)."&table=workspace");				
			} else {
				$msg="Problem with Insert";
				header("Location:index.php?msg=".addslashes($msg)."&table=workspace");
			}
		} else {
			$msg="Please enter the inbox data";
			header("Location:index.php?table=workspace");
		}
	}

?>
