<?php 

session_start();
include "conexion.php";
if (!isset($_SESSION['carrito'])) {

header("location: index.php");
}

  # code...
$arreglo=$_SESSION['carrito'];
$total=0;
for ($i=0; $i <count($arreglo) ; $i++) { 
  # code...
  $total=$total+($arreglo[$i]['Precio']  * $arreglo[$i]['Cantidad']);
}
$fecha = date('Y-m-d h:m:s');
$conexion-> query("insert into ventas(id_usuario,total,fecha) values (1,$total,'$fecha')") or die($conexion -> error);
$id_venta = $conexion -> insert_id;
for ($i=0; $i <count($arreglo) ; $i++) { $conexion -> query("insert into productos_venta (id_venta,id_producto,cantidad,precio,subtotal) values (
$id_venta,
".$arreglo[$i]['Id'].",
".$arreglo[$i]['Cantidad'].",
".$arreglo[$i]['Precio'].",
".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']."
)") or die($conexion -> error);
  # code...
}
unset($_SESSION['carrito']);
 ?>

<!DOCTYPE HTML>
<html>
<head>
<title>checkout</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!--start slider -->
    <link rel="stylesheet" href="css/fwslider.css" media="all">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <script src="js/fwslider.js"></script>
<!--end slider -->
<script src="js/jquery.easydropdown.js"></script>
</head>
<body>
     <div class="header-top">
     <div class="wrap"> 
        <div class="header-top-left">
             <
              </div>
              <div class="box1">
                  <select tabindex="4" class="dropdown">
              <option value="" class="label" value="">Currency :</option>
              <option value="1">$ Dollar</option>
              <option value="2">€ Euro</option>
            </select>
              </div>
              <div class="clear"></div>
         </div>
       <div class="cssmenu">
  
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="header-bottom">
      <div class="wrap">
      <div class="header-bottom-left">
        <div class="logo">
          <a href="index.html"><img src="images/leo.jpg" alt="" width="70px" height="70px" /></a>
        </div>
        <div class="menu">
              <ul class="megamenu skyblue">
      <li class="active grid"><a href="index.php">Home</a></li>
        
      
        <li><a class="color6" href="">Other</a></li>
        <li><a class="color7" href="">Purchase</a></li>
      </ul>
      </div>
    </div>
     <div class="header-bottom-right">
         <div class="search">   
        <input type="text" name="s" class="textbox" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
        <input type="submit" value="Subscribe" id="submit" name="submit">
        <div id="response"> </div>
     </div>
  
    </div>
     <div class="clear"></div>
     </div>
  </div>
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
   
        </div>
        <div class="row">
         
      

            

  

    <div class="site-section" style="width: 900px; height: 400px">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">You order was successfuly completed.</p>
            <p><a href="index.php" class="btn btn-sm btn-primary">Back to shop</a></p>
          </div>
        </div>
      </div>
    </div>


         
        </div>
        <!-- </form> -->
      </div>
    </div>

  </div>
   <div class="footer">
    
    <div class="footer-middle">
      <div class="wrap">
      
       
       
      
      <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="wrap">
              
        <div class="f-list2">
         <ul>
        
         </ul>
          </div>
          <div class="clear"></div>
          </div>
       </div>
  </div>
</body>
</html>