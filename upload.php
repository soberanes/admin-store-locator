<?php

// Where the file is going to be placed
$target_path = "images/theme/";

//alimentamos el generador de aleatorios
srand (time());
//generamos un número aleatorio
$random_key = rand(1,100); 

/* Add the original filename to our target path.
Result is "uploads/filename.extension" */
$target_path = $target_path . $random_key . basename($_FILES['imagen']['name']);

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) {
	//Guardarla en la base de datos
	$conexion=mysql_connect('localhost','hopper_hopper','rNh0LeFEpvGk') or die('No hay conexión a la base de datos');
	$db=mysql_select_db('hopper_gvadmin',$conexion)or die('no existe la base de datos.');
	
	//Desactivar
	$sql="UPDATE template SET active=0 WHERE active=1";
	$res=mysql_query($sql);
	
	unset($sql);
	unset($res);
	$url_image = "http://hoppercat.com/apps/gonvill/".$target_path;
	$sql="INSERT INTO `template`(`background`, `active`) VALUES ('".$url_image."',1);";
	$res=mysql_query($sql);
	
	if($res == 1){
		header("Location: http://hoppercat.com/apps/gonvill/index/theme?upload=success");
	}else{
		header("Location: http://hoppercat.com/apps/gonvill/index/theme?upload=error");
	}

} else {
	header("Location: http://hoppercat.com/apps/gonvill/index/theme?upload=error");
}