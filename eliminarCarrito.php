<?php 
session_start();
$arreglo=$_SESSION['carrito'];
for ($i=0; $i <count($arreglo) ; $i++) { 
 	if ($arreglo[$i]['Id'] != $_POST['id']) {
 		# code...
 		$arregloNuevo[] = array('Id' => $arreglo[$i]['Id'],
 			'Nombre' => $arreglo[$i]['Nombre'],
 			'Precio' => $arreglo[$i]['Precio'],
 			'Imagen' => $arreglo[$i]['Imagen'],
 			'Cantidad' => $arreglo[$i]['Cantidad']
 		);
 	}
 }
 
 	if (isset($arregloNuevo)) {
 		# code...
 		$_SESSION['carrito']=$arregloNuevo;
 	}
 	else
 	{//quiere decir que el registro a elimiar es el unoc que habia 
 		unset($_SESSION['carrito']);
 	}
echo "Listo uwu";

  ?>