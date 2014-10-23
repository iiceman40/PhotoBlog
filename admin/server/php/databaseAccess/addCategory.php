<?php
	require_once('options.php');

	$categoryTitle = $_REQUEST['title'];
	$categoryDescription = $_REQUEST['description'];

	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'INSERT INTO `categories` (`title`, `description`) VALUES (?, ?)';
	$query = $db->prepare($sql);
	$query->bind_param(
		'ss', // type definition
		$categoryTitle,
		$categoryDescription
	);
	$query->execute();

	$category = new stdClass();
	$category->id = $db->insert_id;

	echo json_encode($category);

	$db->close();

?>