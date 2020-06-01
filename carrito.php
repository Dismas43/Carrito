<?php 
  session_start();
  //unset($_SESSION['carrito']);
    include 'conexion.php';
  if (!isset($_SESSION['loggedin'])) {
    header('location: single.php');
  }

  if(isset($_SESSION['carrito'])){
    //si existe buscamos si ya estaba agregado ese producto
    if(isset($_GET['id'])){
      $arreglo =$_SESSION['carrito'];
      $encontro=false;
      $numero = 0;
      for($i=0;$i<count($arreglo);$i++){
        if($arreglo[$i]['Id'] == $_GET['id']){
          $encontro=true;
          $numero=$i;
        }
      }
      if($encontro == true){
        $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
        $_SESSION['carrito']=$arreglo;
      }else{
        /// no estaba el registro
        $nombre ="";
        $precio= "";
        $imagen="";
        $res= $conexion->query('select * from productos where id='.$_GET['id'])or die($conexion->error);
        $fila = mysqli_fetch_row($res);
        
        $nombre=$fila[1];
        $precio = $fila[3];
        $imagen = $fila[4];
        $arregloNuevo= array(
                    'Id'=> $_GET['id'],
                    'Nombre'=> $nombre,
                    'Precio'=>$precio,
                    'Imagen'=> $imagen,
                    'Cantidad' => 1
        );
        array_push($arreglo, $arregloNuevo);
        $_SESSION['carrito']=$arreglo;
      }
    }
  }else{
    //creamos la variable de sesion
    if(isset($_GET['id'])){
      $nombre ="";
      $precio= "";
      $imagen="";
      $res= $conexion->query('select * from productos where id='.$_GET['id'])or die($conexion->error);
      $fila = mysqli_fetch_row($res);
      
      $nombre=$fila[1];
      $precio = $fila[3];
      $imagen = $fila[4];
      $arreglo[] = array(
                  'Id'=> $_GET['id'],
                  'Nombre'=> $nombre,
                  'Precio'=>$precio,
                  'Imagen'=> $imagen,
                  'Cantidad' => 1
      );
      $_SESSION['carrito']=$arreglo;
    }
  }
?>

<!DOCTYPE HTML>
<html>
<head>
<title>CARRITO </title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!-- dropdown -->
<script src="js/jquery.easydropdown.js"></script>
</head>
<body>
       <?php include("header2.php"); ?>
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

	  <div class="tag-list">
	    <ul class="icon1 sub-icon1 profile_img">
			<li><a class="active-icon c1" href="#"> </a>
				<ul class="sub-icon1 list">
					<li><h3>sed diam nonummy</h3><a href=""></a></li>
					<li><p>Lorem ipsum dolor sit amet, consectetuer  <a href="">adipiscing elit, sed diam</a></p></li>
				</ul>
			</li>
		</ul>
		<ul class="icon1 sub-icon1 profile_img">
			<li><a class="active-icon c2" href="#"> </a>
				<ul class="sub-icon1 list">
					<li><h3>No Products</h3><a href=""></a></li>
					<li><p>Lorem ipsum dolor sit amet, consectetuer  <a href="">adipiscing elit, sed diam</a></p></li>
				</ul>
			</li>
		</ul>
	    <ul class="last"><li><a href="#">Cart(<?php if (isset($_SESSION['carrito']))
       {
        echo count($_SESSION['carrito']);
      }
      else
      {
        echo "0";
      }
       ?>)</a></li></ul>
	  </div>
    </div>
     <div class="clear"></div>
     </div>
	</div>
       
    <div class="site-section">

    	  <h1 class="m-4 text-center" style="font-size: 25px" >CARRITO DE COMPRAS</h1>
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php  
                    $total=0;
                     if (isset($_SESSION['carrito'])) {
                      # code...
                     $arreglocarrito=$_SESSION['carrito'];
                    for ($i=0; $i <count($arreglocarrito) ; $i++) { $total=$total+($arreglocarrito[$i]['Precio']*$arreglocarrito[$i]['Cantidad']);
                      # code...
                    
                     ?>
                    <td class="product-thumbnail">
                      <img src="images/<?php echo $arreglocarrito[$i]['Imagen']; ?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arreglocarrito[$i]['Nombre']; ?></h2>
                    </td>
                    <td>$<?php echo $arreglocarrito[$i]['Precio']; ?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                        </div>
                        <input type="number" class="form-control text-center txtcantidad"  
                        data-precio ="<?php echo $arreglocarrito[$i]['Precio'];?>"
                        data-id="<?php echo $arreglocarrito[$i]['Id'];?>"

                         value="<?php echo $arreglocarrito[$i]['Cantidad']; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" min=1>
                        <div class="input-group-append">
                        
                        </div>
                      </div>

                    </td>
               <td class="cant<?php echo $arreglocarrito[$i]['Id']; ?>"><?php echo $arreglocarrito[$i]['Precio'] * $arreglocarrito[$i]['Cantidad']; ?></td>
                    <td><a href="#" class="btn btn-primary btn-sm btn-eliminar" data-id="<?php echo $arreglocarrito[$i]['Id']; ?>">X</a></td>
              </tr>
            <?php } }?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Apply Coupon</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $total;  ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $total; ?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
		<div class="footer-top">
			<div class="wrap">
			  <div class="section group example">
				<div class="col_1_of_2 span_1_of_2">
					
				<div class="col_1_of_2 span_1_of_2">
				

				</div>
				<div class="clear"></div>
		      </div>
			</div>
		</div>
		<div class="footer-middle">
			<div class="wrap">
			 <div class="section group example">
			  <div class="col_1_of_f_1 span_1_of_f_1">
				 <div class="section group example">
				   <div class="col_1_of_f_2 span_1_of_f_2">
				     
 				  </div>
				 
				<div class="clear"></div>
		      </div>
 			 </div>
			 <div class="col_1_of_f_1 span_1_of_f_1">
			   <div class="section group example">
				 <div class="col_1_of_f_2 span_1_of_f_2">
				  
 				 </div>
				 <div class="col_1_of_f_2 span_1_of_f_2">
				   <h3>Contact us</h3>
						<div class="company_address">
					               
					   		
					   </div>
					   <div class="social-media">
						  
					   </div>
				</div>
				<div class="clear"></div>
		    </div>
		   </div>
		  <div class="clear"></div>
		    </div>
		  </div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
		        <div class="copy">
			       
		        </div>
		        <div class="f-list2">
				
			   </div>
				<div class="clear"></div>
		      </div>
			</div>
		</div>
    <script >
      
    </script>
  <script >
    $(document).ready(function(){
$(".btn-eliminar").click(function(event){
  event.preventDefault();
  var id = $(this).data('id');
  var boton=$(this); 
    $.ajax({
    method:'POST',
    url:'eliminarCarrito.php',
    data:{
      id:id
    }
   }).done(function(respuesta){
alert(respuesta);
boton.parent('td').parent('tr').remove();
   });
  
});
 $(".txtcantidad").keyup(function(){
    var cantidad =$(this).val();
    var precio =$(this).data('precio');
    var id = $(this).data('id');
    incrementar(cantidad,precio,id);
   });
   function incrementar(cantidad,precio,id){
    
    var mult= parseFloat(cantidad)* parseFloat(precio);
    $(".cant"+id).text(mult);
     $.ajax({
    method:'POST',
    url:'actualizarCarrito.php',
    data:{
      id:id,
      cantidad:cantidad
    }
   }).done(function(respuesta){


   });
   }
    });
  </script>
</body>
</html>