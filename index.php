<?php
    session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
	}

	$username=$_SESSION["username"];

    @$table = $_GET['table'];
    @$orderBy = $_GET['orderBy'];

	include("configuration.php");


    if($orderBy==''){
	    if ($table=='inbox') {
		$query="select * from inbox where user = '".$username."'";
		}

		elseif ($table=='project') {
		$query="select * from project where user = '".$username."'";
		}

		elseif ($table=='todo') {
		$query="select * from todo where user = '".$username."'";
		}

		elseif ($table=='workspace') {
		$query="select * from workspace where user = '".$username."'";
		}

		else {
		$query="select * from future where user = '".$username."'";	
		}
    }

	else{

	    if ($table=='inbox') {
		$query="select * from inbox where user = '".$username."' order by ".$orderBy;
		}

		elseif ($table=='project') {
		$query="select * from project where user = '".$username."' order by ".$orderBy;
		}

		elseif ($table=='todo') {
		$query="select * from todo where user = '".$username."' order by ".$orderBy;
		}

		elseif ($table=='workspace') {
		$query="select * from workspace where user = '".$username."' order by ".$orderBy;
		}

		else {
		$query="select * from future where user = '".$username."' order by ".$orderBy;	
		}

	}
	
	

	if(isset($_GET['msg'])){
		echo $_GET['msg'];
	}

	if(isset($_GET['msg2'])){
		echo $_GET['msg2'];
	}

	// if(isset($_GET['msg2'])){
	// 	echo $_GET['msg2'];
	// }
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
   $(".nav .nav-link").on("click", function(){
	 $(".nav").find(".active").removeClass("active");
	 $(this).addClass("active");
   });
  </script>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php?table=inbox">Task Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?table=inbox">Inbox</a></li>
      <li><a href="index.php?table=project">Projects</a></li>
      <li><a href="index.php?table=todo">Todo</a></li>
      <li><a href="index.php?table=future">Future</a></li>
      <li><a href="index.php?table=workspace">Job Types</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>


<?php 

if(!isset($_GET['table'])||empty($_GET['table'])){

}
// if($table=='inbox'||empty($table)){
elseif($_GET['table']=='inbox'){
?>
<div class="container">
<table border="1" class="table table-striped" style="width:100%">
<thead>
<tr>
<th colspan="12" style="text-align: center;">Inbox Table</th>
</tr>
<tr>
<th><a href="index.php?table=inbox&orderBy=id">No.</a></th>
<th><a href="index.php?table=inbox&orderBy=time">Time</a></th>
<th><a href="index.php?table=inbox&orderBy=content">Content</a></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>

<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tbody>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['time'];?></td>
<td><?php echo $rowData['content'];?></td>


<td><a href="form.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">EDIT</a></td>
<td><a href="inboxToProject.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">Move to Project</a></td>
<td><a href="inboxToTodo.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">Move to Todo</a></td>
<td><a href="delete.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="12"><a href="form.php?table=<?php echo $_GET['table']; ?>">Insert New Record</a></td>
</tr>
</tbody>
</table>
</div>
<?php
	}
// if($table=='project'){
elseif($table=='project') {
?>
<div class="container">
<table border="1" class="table table-striped" style="width:100%">

<thead>
<tr>
<th colspan="12" style="text-align: center;">Projects Table</th>
</tr>

<tr>
<th><a href="index.php?table=project&orderBy=id">No.</a></th>
<th><a href="index.php?table=project&orderBy=name">Name</a></th>
<th><a href="index.php?table=project&orderBy=goal">Goal</a></th>
<th><a href="index.php?table=project&orderBy=deadline">Deadline</a></th>
<th></th>
<th></th>
</tr>

</thead>

<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tbody>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['name'];?></td>
<td><?php echo $rowData['goal'];?></td>
<td><?php echo $rowData['deadline'];?></td>


<td><a href="form.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">EDIT</a></td>
<td><a href="delete.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="12"><a href="form.php?table=<?php echo $_GET['table']; ?>">Insert New Record</a></td>
</tr>
</tbody>
</table>
</div>
<?php
	}

elseif($table=='todo') {
?>

<div class="container">
<table border="1" class="table table-striped" style="width:100%">

<thead>
<tr>
<th colspan="12" style="text-align: center;">Todo Table</th>
</tr>

<tr>
<th><a href="index.php?table=todo&orderBy=id">No.</a></th>
<th><a href="index.php?table=todo&orderBy=creation_time">Creation_time</a></th>
<th><a href="index.php?table=todo&orderBy=job_type">Job_type</a></th>
<th><a href="index.php?table=todo&orderBy=content">Content</a></th>
<th><a href="index.php?table=todo&orderBy=person">Person</a></th>
<th><a href="index.php?table=todo&orderBy=contact">Contact</a></th>
<th><a href="index.php?table=todo&orderBy=from_project">From_project</a></th>
<th></th>
<th></th>
</tr>
</thead>

<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tbody>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['creation_time'];?></td>
<td><?php echo $rowData['job_type'];?></td>
<td><?php echo $rowData['content'];?></td>
<td><?php echo $rowData['person'];?></td>
<td><?php echo $rowData['contact'];?></td>
<td><?php echo $rowData['from_project'];?></td>


<td><a href="form.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">EDIT</a></td>
<td><a href="delete.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="12"><a href="form.php?table=<?php echo $_GET['table']; ?>">Insert New Record</a></td>
</tr>
</tbody>
</table>
</div>

<?php
	}

elseif($table=='future') {
?>

<div class="container">
<table border="1" class="table table-striped" style="width:100%">

<thead>
<tr>
<th colspan="12" style="text-align: center;">Future Table</th>
</tr>

<tr>
<th><a href="index.php?table=future&orderBy=id">No.</a></th>
<th><a href="index.php?table=future&orderBy=name">Name</a></th>
<th></th>
<th></th>
</tr>

</thead>

<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tbody>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['name'];?></td>


<td><a href="form.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">EDIT</a></td>
<td><a href="delete.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="12"><a href="form.php?table=<?php echo $_GET['table']; ?>">Insert New Record</a></td>
</tr>
</tbody>
</table>
</div>
<?php
	}

elseif($table=='workspace') {
?>
<div class="container">
<table border="1" class="table table-striped" style="width:100%">

<thead>
<tr>
<th colspan="12" style="text-align: center;">Work_Place Table</th>
</tr>

<tr>
<th><a href="index.php?table=workspace&orderBy=id">No.</a></th>
<th><a href="index.php?table=workspace&orderBy=name">Job_type</a></th>
<th></th>
<th></th>
</tr>
</thead>

<?php
	if($resource=mysqli_query($link,$query)){
		$num=1;
		while($rowData=mysqli_fetch_assoc($resource)) {
?>
<tbody>
<tr>
<td><?php echo $num; ?></td>
<td><?php echo $rowData['name'];?></td>


<td><a href="form.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">EDIT</a></td>
<td><a href="delete.php?table=<?php echo $_GET['table']; ?>&id_in_table=<?php echo $rowData['id']; ?>">DELETE</a></td>
</tr>
<?php
		$num ++;
		}
	}
?>
<tr>
<td colspan="12"><a href="form.php?table=<?php echo $_GET['table']; ?>">Insert New Record</a></td>
</tr>
</tbody>
</table>
</div>
<?php
	}
	?>
</body>
