<?php
	require_once('options.php');

	$id = NULL;
	$title = NULL;
	$description = NULL;
	$status = NULL;
	$thumbnails = NULL;

	if(array_key_exists('id', $_REQUEST)) $id = $_REQUEST['id'];
	if(array_key_exists('title', $_REQUEST)) $title = $_REQUEST['title'];
	if(array_key_exists('description', $_REQUEST)) $description = $_REQUEST['description'];
	if(array_key_exists('status', $_REQUEST)) $status = $_REQUEST['status'];
	if(array_key_exists('thumbnails', $_REQUEST)) $thumbnails = $_REQUEST['thumbnails'];


	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'UPDATE `categories` SET `title`=?, `description`=?, `status`=?, `thumbnails`=? WHERE `id`=?';
	$query = $db->prepare($sql);
	$query->bind_param(
		'ssisi', // type definition
		$title,
		$description,
		$status,
		$thumbnails,
		$id
	);
	$query->execute();

	$result = new stdClass();
	$result->success = true;

	echo json_encode($result);

	$db->close();

?>