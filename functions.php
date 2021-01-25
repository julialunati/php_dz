
<?php
  function can_upload($file){
    if($file['name'] == ''){
		return "You haven't selected a file.";
	}
	$getName = explode('.', $file['name']);
	$exp = strtolower(end($getName));
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	if(!in_array($exp, $types)){
		return "Invalid file type.";
	}
	return true;
  }
  
  function make_upload($file){	
	$name = mt_rand(0, 100) . $file['name'];
	copy($file['tmp_name'], 'foto/' . $name);
  }
