
<?php

$link = mysqli_connect('localhost:3306', 'root', 'newpass', 'geekbrains');
if (!$link) {
	die('Connection error');
}

function can_upload($file){

	if ($file['name'] == '') {
		return "You haven't selected a file.";
	}

	$getName = explode('.', $file['name']);

	$exp = strtolower(end($getName));

	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

	if (!in_array($exp, $types)) {
		return "Invalid file type.";
	}

	return true;
}

function make_upload($file){

	$name = mt_rand(0, 100) . $file['name'];

	copy($file['tmp_name'], 'foto/' . $name);

	$link2 = mysqli_connect('localhost:3306', 'root', 'newpass', 'geekbrains');
	$query="INSERT INTO geekbrains.foto VALUES (null,'foto/$name', '$name', 0)";
	mysqli_query($link2, $query);
}
