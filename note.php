<?php

/*****************************Connect Database*****************************/
$con = mysqli_connect('localhost', 'root', '', 'notes');

/*****************************Connect Database*****************************/
if(isset($_GET['get'])){
	$sql = "select * from notes";
	$query = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($query)){
		$data[] = $row;
	}
	echo json_encode( $data, JSON_UNESCAPED_UNICODE );
}

/*****************************Insert Data*****************************/
if(isset($_POST['insert'])){
	$name = check($_POST['name']);
	$body = check($_POST['body']);
	$date = date("Y-m-d");
	$sql = "INSERT INTO `notes`(`name`, `body`, `date`) VALUES ('{$name}','{$body}','{$date}')";
	if($query = mysqli_query($con, $sql))
		echo '{"status": "success"}';
	else 
		echo '{"status": "error"}';
}

/*****************************Update Data*****************************/
if(isset($_POST['update'])){
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	$name = check($_POST['name']);
	$body = check($_POST['body']);
	$date = date("Y-m-d");
	$sql = "UPDATE `notes` SET `name`='{$name}',`body`='{$body}',`date`='{$date}' WHERE `id`='{$id}'";
	if($query = mysqli_query($con, $sql))
		echo '{"status": "success"}';
	else 
		echo '{"status": "error"}';
}

/*****************************Delete Data*****************************/
if(isset($_GET['delete'])){
	$id = $_GET['id'];
	$sql = "DELETE FROM `notes` WHERE `id`='{$id}'";
	if($query = mysqli_query($con, $sql))
		echo '{"status": "success"}';
	else 
		echo '{"status": "error"}';
}

/*****************************Check Function before insert or update*****************************/
function check($field){
	global $con;
	return (htmlentities(trim(mysqli_real_escape_string($con, $field))));
}
