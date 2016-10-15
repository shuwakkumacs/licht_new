<?php
var_dump($_FILES);
	$upfile = basename($_FILES['userfile']['name']);
	if(move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) echo "success";
	else echo "failed";
