<?php

/*****************************Connect Database*****************************/
$con = mysqli_connect('localhost', 'root', '', 'notes');

if(isset($_GET['get'])){
	$sql = "select * from notes";
	$query = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($query)){
		$data[] = $row;
	}
	echo json_encode( $data, JSON_UNESCAPED_UNICODE );
	exit();
}

if(isset($_GET['delete'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM `notes` WHERE `id`='{$id}'";
	if($query = mysqli_query($con, $sql))
		echo '{"status": "success"}';
	else
		echo '{"status": "error"}';
	exit();
}

$json    =  file_get_contents('php://input');
$obj     =  json_decode($json);
$key     =  strip_tags($obj->key);

switch ($key) {
	case "insert":
		$name = check(filter_var($obj->name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
		$body = check(filter_var($obj->body, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
		$date = date("Y-m-d");
		$sql = "INSERT INTO `notes`(`name`, `body`, `date`) VALUES ('{$name}','{$body}','{$date}')";
		if($query = mysqli_query($con, $sql))
			echo '{"status": "success"}';
		else
			echo '{"status": "error"}';
		break;

	case "update":
		$id = filter_var($obj->id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
		$name = check(filter_var($obj->name, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
		$body = check(filter_var($obj->body, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW));
		$date = date("Y-m-d");
		$sql = "UPDATE `notes` SET `name`='{$name}',`body`='{$body}',`date`='{$date}' WHERE `id`='{$id}'";
		if($query = mysqli_query($con, $sql))
			echo '{"status": "success"}';
		else
			echo '{"status": "error"}';
		break;

}
/*****************************Check Function before insert or update*****************************/
function check($field){
	global $con;
	return (htmlentities(trim(mysqli_real_escape_string($con, $field))));
}
