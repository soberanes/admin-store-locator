<?php
// Where the file is going to be placed
$target_path = "images/books/";

//alimentamos el generador de aleatorios
srand (time());
//generamos un número aleatorio
$random_key = rand(1,100);
//Conexión en la base de datos
$conexion=mysql_connect('localhost','hopper_hopper','rNh0LeFEpvGk') or die('No hay conexión a la base de datos');
$db=mysql_select_db('hopper_gvadmin',$conexion)or die('no existe la base de datos.');
/* Add the original filename to our target path.
Result is "uploads/filename.extension" 
 * 
 * 
 * editar aqui, ver si trae archivos $_FILES y validar con eso!! si no trae solo hacer el UPDATE pero sin move_uploaded_file
 * */



if($_POST['accion'] == 'editar'){
	
	if($_FILES["portada"]["error"]==0){
		$target_path = $target_path . $random_key . basename($_FILES['portada']['name']);
		if (move_uploaded_file($_FILES['portada']['tmp_name'], $target_path)) {
			$url_image = "http://hoppercat.com/apps/gonvill/".$target_path;
			$sql="UPDATE books SET image='".$url_image."' WHERE id= " . $_POST['libro'];
			$res=mysql_query($sql);
			
		}else{
			header("Location: http://hoppercat.com/apps/gonvill/index/editar?id=".$_POST['id']."&save=error");
		}
	}
	
	//Editar
	unset($sql);
	unset($res);
	$sql="UPDATE books SET title='".$_POST['titulo']."', author='".$_POST['autor']."', code='".$_POST['codigo']."', cost='".$_POST['costo']."', link='".$_POST['link']."' WHERE id= " . $_POST['libro'];
	$res=mysql_query($sql);
	
	if($res == 1){
		header("Location: http://hoppercat.com/apps/gonvill/index/editar?id=".$_POST['libro']."&save=success");
	}else{
		header("Location: http://hoppercat.com/apps/gonvill/index/editar?id=".$_POST['libro']."&save=error");
	}
	
}else{
	$target_path = $target_path . $random_key . basename($_FILES['portada']['name']);
	
	if (move_uploaded_file($_FILES['portada']['tmp_name'], $target_path)) {
		
		unset($sql);
		unset($res);
		$url_image = "http://hoppercat.com/apps/gonvill/".$target_path;

		
		
		//Desactivar
		$sql="INSERT INTO books (title, author, code, cost, image, link, active) VALUES ('".$_POST['titulo']."', '".$_POST['autor']."', '".$_POST['codigo']."', '".$_POST['costo']."', '".$url_image."', '".$_POST['link']."', 1 )";
		$res=mysql_query($sql);
		
		if($res == 1){
			header("Location: http://hoppercat.com/apps/gonvill/index/nuevo?save=success");
		}else{
			header("Location: http://hoppercat.com/apps/gonvill/index/nuevo?save=error");
		}
		
	
	} else {
		header("Location: http://hoppercat.com/apps/gonvill/index/nuevo?save=error");
	}
	
}


