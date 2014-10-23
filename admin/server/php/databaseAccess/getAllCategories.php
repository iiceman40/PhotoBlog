<?php
	require_once('options.php');

	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'SELECT `id`, `title`, `description`, `status`, `thumbnails` FROM `categories`';
	$query = $db->prepare($sql);
	//$query->bind_param('s', $file->name);
	$query->execute();
	$query->bind_result(
		$id,
		$title,
		$description,
		$status,
		$thumbnails
	);
	$categories = array();
	while ($query->fetch()) {
		$category = new stdClass();
		$category->id = $id;
		$category->title = $title;
		$category->description = $description;
		$category->status = $status;
		$category->thumbnails = $thumbnails;
		$categories[] = $category;
	}

	echo json_encode($categories);

	$db->close();

?>