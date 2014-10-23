<?php
	require_once('options.php');

	$id = NULL;
	$title = NULL;
	$description = NULL;
	$categories = NULL;

	if(array_key_exists('id', $_REQUEST)) $id = $_REQUEST['id'];
	if(array_key_exists('title', $_REQUEST)) $title = $_REQUEST['title'];
	if(array_key_exists('description', $_REQUEST)) $description = $_REQUEST['description'];
	if(array_key_exists('categories', $_REQUEST)) $categories = $_REQUEST['categories'];

	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'UPDATE `images` SET `title`=?, `description`=?, `categories`=? WHERE `id`=?';
	$query = $db->prepare($sql);
	$query->bind_param(
		'sssi', // type definition
		$title,
		$description,
		$categories,
		$id
	);
	$query->execute();

	$result = new stdClass();
	$result->success = true;

	echo json_encode($result);

	$db->close();

?>