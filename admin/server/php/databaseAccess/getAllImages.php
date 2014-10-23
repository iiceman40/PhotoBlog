<?php
	require_once('options.php');

	$db = new mysqli(
		$options['db_host'],
		$options['db_user'],
		$options['db_pass'],
		$options['db_name']
	);

	$sql = 'SELECT `id`, `type`, `title`, `name`, `description`, `categories` FROM `' . $options['db_table'].'`';
	$query = $db->prepare($sql);
	//$query->bind_param('s', $file->name);
	$query->execute();
	$query->bind_result(
		$id,
		$type,
		$title,
		$name,
		$description,
		$categories
	);
	$images = array();
	while ($query->fetch()) {
		$image = new stdClass();
		$image->id = $id;
		$image->type = $type;
		$image->title = $title;
		$image->name = $name;
		$image->description = $description;
		$image->categories = $categories;
		$images[] = $image;
	}

	echo json_encode($images);

	$db->close();

?>