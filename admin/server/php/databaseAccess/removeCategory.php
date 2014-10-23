<?php
	require_once('options.php');

	$id = NULL;

	if(array_key_exists('id', $_REQUEST)) $id = $_REQUEST['id'];

	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'DELETE FROM `categories` WHERE `id`=?';
	$query = $db->prepare($sql);
	$query->bind_param(
		'i', // type definition
		$id
	);
	$query->execute();

	$result = new stdClass();
	$result->success = true;

	echo json_encode($result);

	$db->close();

?>