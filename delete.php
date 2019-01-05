<?php
	include("configuration.php");
	if(isset($_GET['id_in_table']) && !empty($_GET['id_in_table']) && isset($_GET['table']) && !empty($_GET['table'])){
		$table=$_GET['table'];
		$query="DELETE FROM ".$table." where id='".$_GET['id_in_table']."'";
		$result= mysqli_query($link,$query);
		if($result){
			$msg="Data deleted successfully";
			header("Location:index.php?msg=".$msg."&table=".$table);
		}
	}
?>